<?php

namespace LaravelMcpDemo\MenuBuilder\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use LaravelMcpDemo\MenuBuilder\Database\Factories\MenuItemFactory;

class MenuItem extends Model
{
    /** @use HasFactory<MenuItemFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'parent_id',
        'label',
        'slug',
        'route_name',
        'view',
        'sort_order',
        'is_active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The default values for attributes.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'sort_order' => 0,
        'is_active' => true,
    ];

    protected static function newFactory(): MenuItemFactory
    {
        return MenuItemFactory::new();
    }

    protected static function booted(): void
    {
        static::saving(function (self $menuItem): void {
            $routeName = self::normalizeRouteName((string) $menuItem->getAttribute('route_name'));

            if ($routeName === '') {
                $routeName = self::makeUniqueRouteNameFromTitle(
                    (string) $menuItem->getAttribute('label'),
                    $menuItem->exists ? (int) $menuItem->getKey() : null,
                );
            }

            $menuItem->setAttribute('route_name', $routeName);
        });
    }

    public static function makeUniqueRouteNameFromTitle(string $title, ?int $ignoreMenuItemId = null): string
    {
        return self::makeUniqueRouteName(self::routeNameFromTitle($title), $ignoreMenuItemId);
    }

    public static function routeNameFromTitle(string $title): string
    {
        $routeName = self::normalizeRouteName(Str::slug($title, '.'));

        return $routeName === '' ? 'seite' : $routeName;
    }

    public static function normalizeRouteName(string $routeName): string
    {
        return collect(explode('.', str_replace(['/', '\\'], '.', $routeName)))
            ->map(fn (string $segment): string => Str::slug($segment))
            ->filter()
            ->implode('.');
    }

    private static function makeUniqueRouteName(string $routeName, ?int $ignoreMenuItemId = null): string
    {
        $baseRouteName = self::normalizeRouteName($routeName);
        $baseRouteName = $baseRouteName === '' ? 'seite' : $baseRouteName;
        $candidate = $baseRouteName;
        $counter = 2;

        while (
            self::query()
                ->where('route_name', $candidate)
                ->when($ignoreMenuItemId, fn (Builder $query): Builder => $query->whereKeyNot($ignoreMenuItemId))
                ->exists()
        ) {
            $candidate = "{$baseRouteName}.{$counter}";
            $counter++;
        }

        return $candidate;
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'parent_id' => 'integer',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('label');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
