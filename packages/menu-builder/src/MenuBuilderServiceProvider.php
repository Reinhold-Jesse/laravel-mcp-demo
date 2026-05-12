<?php

namespace LaravelMcpDemo\MenuBuilder;

use Filament\Panel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use LaravelMcpDemo\MenuBuilder\Filament\Pages\MenuBuilder as MenuBuilderPage;
use LaravelMcpDemo\MenuBuilder\Http\Controllers\DynamicPageController;
use LaravelMcpDemo\MenuBuilder\Livewire\MenuBuilder;
use LaravelMcpDemo\MenuBuilder\Livewire\MenuNavigation;
use LaravelMcpDemo\MenuBuilder\Support\MenuItemRepository;
use Livewire\Livewire;

class MenuBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/menu-builder.php', 'menu-builder');

        Panel::configureUsing(function (Panel $panel): void {
            if ($panel->getId() !== config('menu-builder.panel_id', 'dashboard')) {
                return;
            }

            $panel->pages([
                MenuBuilderPage::class,
            ]);
        });
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'menu-builder');

        Livewire::component(config('menu-builder.livewire.builder_alias', 'menu-builder.builder'), MenuBuilder::class);
        Livewire::component(config('menu-builder.livewire.navigation_alias', 'menu-builder.navigation'), MenuNavigation::class);

        if (config('menu-builder.livewire.register_legacy_aliases', false)) {
            Livewire::component('menu-builder', MenuBuilder::class);
            Livewire::component('menu-navigation', MenuNavigation::class);
        }

        $this->registerModelCacheInvalidation();

        $this->app->booted(function (): void {
            $this->registerRoutes();
        });

        $this->publishes([
            __DIR__.'/../config/menu-builder.php' => config_path('menu-builder.php'),
        ], 'menu-builder-config');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/menu-builder'),
        ], 'menu-builder-views');
    }

    private function registerRoutes(): void
    {
        $this->registerNamedMenuItemRoutes();

        Route::middleware('web')->group(function (): void {
            Route::get('/', DynamicPageController::class)
                ->defaults('menuBuilderSlug', '/')
                ->name('menu-builder.pages.root');

            Route::fallback(DynamicPageController::class)
                ->name('menu-builder.pages.show');
        });
    }

    private function registerNamedMenuItemRoutes(): void
    {
        if (! $this->canQueryMenuItems()) {
            return;
        }

        app(MenuItemRepository::class)
            ->activeItems()
            ->each(function (Model $menuItem): void {
                $this->registerNamedMenuItemRoute($menuItem);
            });
    }

    private function registerNamedMenuItemRoute(Model $menuItem): void
    {
        $routeName = (string) $menuItem->getAttribute('route_name');

        if (! (bool) $menuItem->getAttribute('is_active') || blank($routeName) || Route::has($routeName)) {
            return;
        }

        $slug = (string) $menuItem->getAttribute('slug');
        $uri = $slug === '/' ? '/' : trim($slug, '/');

        Route::middleware('web')
            ->get($uri, DynamicPageController::class)
            ->defaults('menuBuilderSlug', $slug)
            ->name($routeName);

        Route::getRoutes()->refreshNameLookups();
    }

    private function canQueryMenuItems(): bool
    {
        $table = app(MenuItemRepository::class)->table();

        return Schema::hasTable($table) && Schema::hasColumn($table, 'route_name');
    }

    private function registerModelCacheInvalidation(): void
    {
        /** @var class-string<Model>|null $modelClass */
        $modelClass = config('menu-builder.model');

        if (! is_string($modelClass) || ! is_a($modelClass, Model::class, true)) {
            return;
        }

        $clearCache = function (): void {
            app(MenuItemRepository::class)->forgetActiveItems();
        };

        $modelClass::saved(function (Model $menuItem) use ($clearCache): void {
            $clearCache();
            $this->registerNamedMenuItemRoute($menuItem);
        });

        $modelClass::deleted($clearCache);
    }
}
