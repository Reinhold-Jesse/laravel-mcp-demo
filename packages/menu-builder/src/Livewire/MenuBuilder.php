<?php

namespace LaravelMcpDemo\MenuBuilder\Livewire;

use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use LaravelMcpDemo\MenuBuilder\Models\MenuItem;
use LaravelMcpDemo\MenuBuilder\Support\MenuBuilderViewResolver;
use LaravelMcpDemo\MenuBuilder\Support\MenuItemRepository;
use Livewire\Component;

class MenuBuilder extends Component
{
    public ?int $selectedMenuItemId = null;

    /**
     * @var array{parent_id: int|null, label: string, slug: string, route_name: string, view: string, is_active: bool}
     */
    public array $form = [
        'parent_id' => null,
        'label' => '',
        'slug' => '',
        'route_name' => '',
        'view' => '',
        'is_active' => true,
    ];

    public function mount(): void
    {
        $this->authorizeManageMenu();

        $menuItemId = $this->query()
            ->orderBy('sort_order')
            ->orderBy('label')
            ->value('id');

        $this->selectedMenuItemId = $menuItemId === null ? null : (int) $menuItemId;

        $this->loadSelectedMenuItem();
    }

    public function render(): View
    {
        return view('menu-builder::livewire.menu-builder', [
            'menuTree' => $this->getMenuTree(),
            'parentOptions' => $this->getParentOptions(),
            'selectedMenuItem' => $this->getSelectedMenuItem(),
        ]);
    }

    public function urlFor(Model $menuItem): string
    {
        $routeName = (string) $menuItem->getAttribute('route_name');

        if (filled($routeName) && Route::has($routeName)) {
            return route($routeName);
        }

        $slug = (string) $menuItem->getAttribute('slug');

        if ($slug === '/') {
            return url('/');
        }

        return url($slug);
    }

    public function selectMenuItem(int $menuItemId): void
    {
        $this->authorizeManageMenu();

        $this->selectedMenuItemId = $menuItemId;

        $this->loadSelectedMenuItem();
    }

    public function createRootItem(): void
    {
        $this->authorizeManageMenu();

        $this->createMenuItem();
    }

    public function createChildItem(): void
    {
        $this->authorizeManageMenu();

        $this->createMenuItem($this->selectedMenuItemId);
    }

    public function saveSelectedMenuItem(): void
    {
        $this->authorizeManageMenu();

        if ($this->selectedMenuItemId === null) {
            return;
        }

        $this->form['parent_id'] = blank($this->form['parent_id']) ? null : (int) $this->form['parent_id'];
        $this->form['slug'] = $this->normalizeSlug($this->form['slug']);
        $routeName = MenuItem::normalizeRouteName($this->form['route_name']);
        $this->form['route_name'] = $routeName === ''
            ? MenuItem::makeUniqueRouteNameFromTitle($this->form['label'], $this->selectedMenuItemId)
            : $routeName;
        $this->form['view'] = trim($this->form['view']);
        $this->form['is_active'] = (bool) $this->form['is_active'];

        if ($this->form['parent_id'] === $this->selectedMenuItemId) {
            $this->addError('form.parent_id', 'Ein Menüpunkt kann nicht sein eigener Elternpunkt sein.');

            return;
        }

        if (
            $this->form['parent_id'] !== null
            && $this->isDescendantOf($this->form['parent_id'], $this->selectedMenuItemId)
        ) {
            $this->addError('form.parent_id', 'Ein Menüpunkt kann nicht unter einem eigenen Kind verschoben werden.');

            return;
        }

        /** @var array{form: array{parent_id: int|null, label: string, slug: string, route_name: string, view: string, is_active: bool}} $validated */
        $validated = $this->validate([
            'form.parent_id' => ['nullable', 'integer', 'exists:'.$this->menuItemsTable().',id'],
            'form.label' => ['required', 'string', 'max:255'],
            'form.slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique($this->menuItemsTable(), 'slug')->ignore($this->selectedMenuItemId),
            ],
            'form.route_name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9._-]+$/',
                Rule::unique($this->menuItemsTable(), 'route_name')->ignore($this->selectedMenuItemId),
            ],
            'form.view' => ['required', 'string', 'max:255', app(MenuBuilderViewResolver::class)->validationRule()],
            'form.is_active' => ['boolean'],
        ]);

        DB::transaction(function () use ($validated): void {
            $this->query()
                ->findOrFail($this->selectedMenuItemId)
                ->update($validated['form']);
        });

        $this->forgetNavigationCache();

        $this->loadSelectedMenuItem();

        Notification::make()
            ->title('Menüpunkt gespeichert')
            ->success()
            ->send();
    }

    public function deleteSelectedMenuItem(): void
    {
        $this->authorizeManageMenu();

        if ($this->selectedMenuItemId === null) {
            return;
        }

        DB::transaction(function (): void {
            $this->query()
                ->findOrFail($this->selectedMenuItemId)
                ->delete();
        });

        $this->forgetNavigationCache();

        $menuItemId = $this->query()
            ->orderBy('sort_order')
            ->orderBy('label')
            ->value('id');

        $this->selectedMenuItemId = $menuItemId === null ? null : (int) $menuItemId;

        $this->loadSelectedMenuItem();

        Notification::make()
            ->title('Menüpunkt gelöscht')
            ->success()
            ->send();
    }

    public function regenerateSlug(): void
    {
        $this->authorizeManageMenu();

        $label = $this->form['label'] ?: 'Neue Seite';
        $parentId = blank($this->form['parent_id']) ? null : (int) $this->form['parent_id'];
        $parentSlug = $parentId === null ? null : $this->query()->whereKey($parentId)->value('slug');

        $this->form['slug'] = $this->makeUniqueSlug(
            filled($parentSlug) ? "{$parentSlug}/{$label}" : $label,
            $this->selectedMenuItemId,
        );
    }

    public function regenerateRouteName(): void
    {
        $this->authorizeManageMenu();

        $label = $this->form['label'] ?: 'Neue Seite';

        $this->form['route_name'] = MenuItem::makeUniqueRouteNameFromTitle(
            $label,
            $this->selectedMenuItemId,
        );
    }

    public function moveMenuItem(int|string $menuItemId, int|string $position, int|string|null $parentId = null): void
    {
        $this->authorizeManageMenu();

        $menuItem = $this->query()->findOrFail((int) $menuItemId);
        $newParentId = $this->normalizeParentGroup($parentId);

        if ($newParentId === (int) $menuItem->getKey() || ($newParentId !== null && $this->isDescendantOf($newParentId, (int) $menuItem->getKey()))) {
            Notification::make()
                ->title('Verschieben nicht möglich')
                ->body('Ein Menüpunkt kann nicht unter sich selbst oder einem eigenen Kind liegen.')
                ->danger()
                ->send();

            return;
        }

        DB::transaction(function () use ($menuItem, $newParentId, $position): void {
            $menuItem->forceFill(['parent_id' => $newParentId])->save();

            $this->reorderSiblings($newParentId, $menuItem, (int) $position);
        });

        $this->forgetNavigationCache();

        if ($this->selectedMenuItemId === (int) $menuItem->getKey()) {
            $this->loadSelectedMenuItem();
        }
    }

    private function createMenuItem(?int $parentId = null): void
    {
        /** @var Model|null $parent */
        $parent = $parentId === null ? null : $this->query()->find($parentId);
        $baseLabel = 'Neue Seite';
        $sortOrder = ((int) $this->siblingsQuery($parent?->getKey())->max('sort_order')) + 10;
        $parentSlug = $parent?->getAttribute('slug');

        $menuItem = DB::transaction(fn (): Model => $this->query()->create([
            'parent_id' => $parent?->getKey(),
            'label' => $baseLabel,
            'slug' => $this->makeUniqueSlug($parent === null ? $baseLabel : "{$parentSlug}/{$baseLabel}"),
            'view' => app(MenuBuilderViewResolver::class)->defaultView(),
            'sort_order' => $sortOrder,
            'is_active' => true,
        ]));

        $this->forgetNavigationCache();

        $this->selectedMenuItemId = (int) $menuItem->getKey();
        $this->loadSelectedMenuItem();
        $this->form['route_name'] = '';

        Notification::make()
            ->title('Menüpunkt erstellt')
            ->success()
            ->send();
    }

    private function loadSelectedMenuItem(): void
    {
        $menuItem = $this->getSelectedMenuItem();

        if ($menuItem === null) {
            $this->form = [
                'parent_id' => null,
                'label' => '',
                'slug' => '',
                'route_name' => '',
                'view' => '',
                'is_active' => true,
            ];

            return;
        }

        $this->form = [
            'parent_id' => $this->parentId($menuItem),
            'label' => (string) $menuItem->getAttribute('label'),
            'slug' => (string) $menuItem->getAttribute('slug'),
            'route_name' => (string) $menuItem->getAttribute('route_name'),
            'view' => (string) $menuItem->getAttribute('view'),
            'is_active' => (bool) $menuItem->getAttribute('is_active'),
        ];
    }

    private function getSelectedMenuItem(): ?Model
    {
        if ($this->selectedMenuItemId === null) {
            return null;
        }

        return $this->query()->find($this->selectedMenuItemId);
    }

    /**
     * @return array<int, array{id: int, parent_id: int|null, label: string, slug: string, route_name: string, view: string, is_active: bool, children: array<int, mixed>}>
     */
    private function getMenuTree(): array
    {
        /** @var Collection<int, Model> $menuItems */
        $menuItems = $this->query()
            ->select(['id', 'parent_id', 'label', 'slug', 'route_name', 'view', 'sort_order', 'is_active'])
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get();

        return $this->buildMenuTree($this->groupMenuItemsByParent($menuItems));
    }

    /**
     * @param  Collection<string, Collection<int, Model>>  $menuItemsByParent
     * @return array<int, array{id: int, parent_id: int|null, label: string, slug: string, route_name: string, view: string, is_active: bool, children: array<int, mixed>}>
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
                'view' => (string) $menuItem->getAttribute('view'),
                'is_active' => (bool) $menuItem->getAttribute('is_active'),
                'children' => $this->buildMenuTree($menuItemsByParent, (int) $menuItem->getKey()),
            ])
            ->values()
            ->all();
    }

    /**
     * @return array<int, string>
     */
    private function getParentOptions(): array
    {
        $excludedIds = $this->selectedMenuItemId === null
            ? []
            : [$this->selectedMenuItemId, ...$this->getDescendantIds($this->selectedMenuItemId)];

        return $this->query()
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get(['id', 'label'])
            ->reject(fn (Model $menuItem): bool => in_array((int) $menuItem->getKey(), $excludedIds, true))
            ->mapWithKeys(fn (Model $menuItem): array => [(int) $menuItem->getKey() => (string) $menuItem->getAttribute('label')])
            ->all();
    }

    /**
     * @return array<int, int>
     */
    private function getDescendantIds(int $menuItemId): array
    {
        /** @var Collection<int, Model> $menuItems */
        $menuItems = $this->query()
            ->get(['id', 'parent_id']);

        return $this->collectDescendantIds($this->groupMenuItemsByParent($menuItems), $menuItemId);
    }

    /**
     * @param  Collection<string, Collection<int, Model>>  $menuItemsByParent
     * @return array<int, int>
     */
    private function collectDescendantIds(Collection $menuItemsByParent, int $parentId): array
    {
        return $menuItemsByParent
            ->get($this->parentKey($parentId), collect())
            ->flatMap(fn (Model $menuItem): array => [
                (int) $menuItem->getKey(),
                ...$this->collectDescendantIds($menuItemsByParent, (int) $menuItem->getKey()),
            ])
            ->values()
            ->all();
    }

    private function isDescendantOf(int $candidateMenuItemId, int $parentMenuItemId): bool
    {
        return in_array($candidateMenuItemId, $this->getDescendantIds($parentMenuItemId), true);
    }

    private function reorderSiblings(?int $parentId, Model $movedMenuItem, int $position): void
    {
        $siblings = $this->siblingsQuery($parentId)
            ->whereKeyNot($movedMenuItem->getKey())
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get();

        $position = max(0, min($position, $siblings->count()));
        $siblings->splice($position, 0, [$movedMenuItem]);

        $siblings
            ->values()
            ->each(function (Model $menuItem, int $index) use ($parentId): void {
                $menuItem->forceFill([
                    'parent_id' => $parentId,
                    'sort_order' => $index * 10,
                ])->save();
            });
    }

    private function siblingsQuery(int|string|null $parentId): Builder
    {
        $parentId = $parentId === null ? null : (int) $parentId;

        return $this->query()
            ->when(
                $parentId === null,
                fn (Builder $query): Builder => $query->whereNull('parent_id'),
                fn (Builder $query): Builder => $query->where('parent_id', $parentId),
            );
    }

    private function normalizeParentGroup(int|string|null $parentId): ?int
    {
        if ($parentId === null || $parentId === '' || $parentId === 'root') {
            return null;
        }

        return (int) $parentId;
    }

    private function makeUniqueSlug(string $baseSlug, ?int $ignoreMenuItemId = null): string
    {
        $baseSlug = $this->normalizeSlug($baseSlug);
        $candidate = $baseSlug;
        $counter = 2;

        while (
            $this->query()
                ->where('slug', $candidate)
                ->when($ignoreMenuItemId, fn (Builder $query): Builder => $query->whereKeyNot($ignoreMenuItemId))
                ->exists()
        ) {
            $candidate = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $candidate;
    }

    private function normalizeSlug(string $slug): string
    {
        if (trim($slug) === '/') {
            return '/';
        }

        $normalizedSlug = collect(explode('/', $slug))
            ->map(fn (string $segment): string => Str::slug($segment))
            ->filter()
            ->implode('/');

        return $normalizedSlug === '' ? 'seite' : $normalizedSlug;
    }

    private function parentId(Model $menuItem): ?int
    {
        $parentId = $menuItem->getAttribute('parent_id');

        return $parentId === null ? null : (int) $parentId;
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

    private function forgetNavigationCache(): void
    {
        app(MenuItemRepository::class)->forgetActiveItems();
    }

    private function authorizeManageMenu(): void
    {
        if (! config('menu-builder.authorization.enabled', true)) {
            return;
        }

        $ability = config('menu-builder.authorization.ability');

        if (filled($ability)) {
            Gate::authorize((string) $ability, config('menu-builder.model'));

            return;
        }

        abort_unless(auth()->check(), 403);
    }

    private function query(): Builder
    {
        /** @var class-string<Model> $modelClass */
        $modelClass = config('menu-builder.model');

        return $modelClass::query();
    }

    private function menuItemsTable(): string
    {
        /** @var class-string<Model> $modelClass */
        $modelClass = config('menu-builder.model');

        return (new $modelClass)->getTable();
    }
}
