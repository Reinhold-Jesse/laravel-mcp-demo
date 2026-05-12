<?php

namespace LaravelMcpDemo\MenuBuilder\Support;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class MenuItemRepository
{
    public function query(): Builder
    {
        return $this->modelClass()::query();
    }

    public function table(): string
    {
        $modelClass = $this->modelClass();

        return (new $modelClass)->getTable();
    }

    public function findActiveBySlug(string $slug): ?Model
    {
        return $this->query()
            ->where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }

    /**
     * @return Collection<int, Model>
     */
    public function activeItems(): Collection
    {
        if (! config('menu-builder.cache.enabled', true)) {
            return $this->fetchActiveItems();
        }

        $cachedItems = Cache::get($this->activeItemsCacheKey());

        if (is_array($cachedItems) && $this->containsOnlyAttributeArrays($cachedItems)) {
            return $this->hydrateActiveItems($cachedItems);
        }

        if ($cachedItems !== null) {
            $this->forgetActiveItems();
        }

        $activeItems = $this->fetchActiveItems();

        Cache::put(
            $this->activeItemsCacheKey(),
            $this->serializeActiveItems($activeItems),
            (int) config('menu-builder.cache.ttl', 300),
        );

        return $activeItems;
    }

    public function forgetActiveItems(): bool
    {
        return Cache::forget($this->activeItemsCacheKey());
    }

    public function tableExists(): bool
    {
        if (! config('menu-builder.database.check_table_exists', false)) {
            return true;
        }

        return Cache::remember(
            (string) config('menu-builder.cache.table_exists_key', 'menu-builder.table-exists').'.'.$this->table(),
            (int) config('menu-builder.cache.ttl', 300),
            fn (): bool => Schema::hasTable($this->table()),
        );
    }

    /**
     * @return Collection<int, Model>
     */
    private function fetchActiveItems(): Collection
    {
        return $this->query()
            ->select(['id', 'parent_id', 'label', 'slug', 'sort_order', 'is_active'])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get();
    }

    private function activeItemsCacheKey(): string
    {
        return (string) config('menu-builder.cache.key', 'menu-builder.active-items');
    }

    /**
     * @return class-string<Model>
     */
    private function modelClass(): string
    {
        /** @var class-string<Model> $modelClass */
        $modelClass = config('menu-builder.model');

        return $modelClass;
    }

    /**
     * @param  array<int, array<string, mixed>>  $items
     * @return Collection<int, Model>
     */
    private function hydrateActiveItems(array $items): Collection
    {
        $modelClass = $this->modelClass();

        return $modelClass::hydrate($items);
    }

    /**
     * @param  Collection<int, Model>  $items
     * @return array<int, array<string, mixed>>
     */
    private function serializeActiveItems(Collection $items): array
    {
        return $items
            ->map(fn (Model $item): array => $item->getAttributes())
            ->values()
            ->all();
    }

    /**
     * @param  array<mixed>  $items
     */
    private function containsOnlyAttributeArrays(array $items): bool
    {
        foreach ($items as $item) {
            if (! is_array($item)) {
                return false;
            }
        }

        return true;
    }
}
