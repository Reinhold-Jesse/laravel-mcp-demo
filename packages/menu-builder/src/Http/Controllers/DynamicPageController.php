<?php

namespace LaravelMcpDemo\MenuBuilder\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelMcpDemo\MenuBuilder\Support\MenuBuilderViewResolver;
use LaravelMcpDemo\MenuBuilder\Support\MenuItemRepository;

class DynamicPageController extends Controller
{
    public function __construct(private readonly MenuBuilderViewResolver $viewResolver) {}

    public function __invoke(Request $request, ?string $menuBuilderSlug = null): View
    {
        $slug = $this->normalizeSlug($menuBuilderSlug ?? $request->path());
        $menuItems = app(MenuItemRepository::class);

        if (! $menuItems->tableExists()) {
            abort(404);
        }

        $menuItem = $menuItems->findActiveBySlug($slug);

        abort_if($menuItem === null, 404);

        $view = (string) $menuItem->getAttribute('view');

        abort_unless($this->viewResolver->canRender($view), 404);

        return view(
            $view,
            [
                'menuItem' => $menuItem,
                'pageTitle' => $this->pageTitle($menuItem),
            ],
        );
    }

    private function normalizeSlug(string $slug): string
    {
        $slug = trim($slug, '/');

        return $slug === '' ? '/' : $slug;
    }

    private function pageTitle(Model $menuItem): string
    {
        return (string) $menuItem->getAttribute('label');
    }
}
