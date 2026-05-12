<?php

namespace LaravelMcpDemo\MenuBuilder\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use LaravelMcpDemo\MenuBuilder\Support\MenuItemRepository;
use Livewire\Component;

class MenuNavigation extends Component
{
    public function render(): View
    {
        return view('menu-builder::livewire.menu-navigation', [
            'menuTree' => $this->getMenuTree(),
        ]);
    }

    public function urlFor(string $slug, ?string $routeName = null): string
    {
        if (filled($routeName) && Route::has($routeName)) {
            return route($routeName);
        }

        if ($slug === '/') {
            return url('/');
        }

        return url($slug);
    }

    /**
     * @return array<int, array{id: int, parent_id: int|null, label: string, slug: string, route_name: string, children: array<int, mixed>}>
     */
    private function getMenuTree(): array
    {
        $menuItems = app(MenuItemRepository::class)->activeItems();

        return $this->buildMenuTree($this->groupMenuItemsByParent($menuItems));
    }

    /**
     * @param  Collection<string, Collection<int, Model>>  $menuItemsByParent
     * @return array<int, array{id: int, parent_id: int|null, label: string, slug: string, route_name: string, children: array<int, mixed>}>
     */
    private function buildMenuTree(Collection $menuItemsByParent, ?int $parentId = null): array
    {
        return $menuItemsByParent
            ->get($this->parentKey($parentId), collect())
            ->map(fn (Model $menuItem): array => [
                'id' => (int) $menuItem->getKey(),
                'parent_id' => $this->parentId($menuItem),
                'label' => (string) $menuItem->getAttribute('label'),
                'slug' => (string) $menuItem->getAttribute('slug'),
                'route_name' => (string) $menuItem->getAttribute('route_name'),
                'children' => $this->buildMenuTree($menuItemsByParent, (int) $menuItem->getKey()),
            ])
            ->values()
            ->all();
    }

    /**
     * @param  Collection<int, Model>  $menuItems
     * @return Collection<string, Collection<int, Model>>
     */
    private function groupMenuItemsByParent(Collection $menuItems): Collection
    {
        return $menuItems->groupBy(fn (Model $menuItem): string => $this->parentKey($this->parentId($menuItem)));
    }

    private function parentKey(?int $parentId): string
    {
        return $parentId === null ? 'root' : (string) $parentId;
    }

    private function parentId(Model $menuItem): ?int
    {
        $parentId = $menuItem->getAttribute('parent_id');

        return $parentId === null ? null : (int) $parentId;
    }
}
