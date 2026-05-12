<?php

use App\Filament\Clusters\Settings\SettingsCluster;
use App\Filament\Resources\MenuItems\MenuItemResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use LaravelMcpDemo\MenuBuilder\Database\Seeders\MenuItemSeeder;
use LaravelMcpDemo\MenuBuilder\Models\MenuItem;

uses(RefreshDatabase::class);

test('menu items can have nested children', function () {
    $parent = MenuItem::factory()->create([
        'label' => 'Produkte',
        'slug' => 'products',
        'view' => 'pages.products',
    ]);

    $firstChild = MenuItem::factory()->childOf($parent)->create([
        'label' => 'Hardware',
        'slug' => 'products/hardware',
        'view' => 'pages.products.hardware',
        'sort_order' => 20,
    ]);

    $secondChild = MenuItem::factory()->childOf($parent)->create([
        'label' => 'Software',
        'slug' => 'products/software',
        'view' => 'pages.products.software',
        'sort_order' => 10,
    ]);

    expect($firstChild->parent->is($parent))->toBeTrue()
        ->and($parent->children)->toHaveCount(2)
        ->and($parent->children->first()->is($secondChild))->toBeTrue();
});

test('menu item seeder creates fifty active menu entries', function () {
    $this->seed(MenuItemSeeder::class);

    $products = MenuItem::query()
        ->where('slug', 'products')
        ->firstOrFail();

    $hardware = MenuItem::query()
        ->where('slug', 'products/hardware')
        ->firstOrFail();

    expect(MenuItem::query()->count())->toBe(50)
        ->and(MenuItem::query()->active()->count())->toBe(50)
        ->and($products->route_name)->toBe('products')
        ->and($products->children)->toHaveCount(6)
        ->and($hardware->route_name)->toBe('products.hardware')
        ->and($hardware->view)->toBe('pages.dynamic')
        ->and($hardware->parent->is($products))->toBeTrue();
});

test('menu items are registered in the settings cluster', function () {
    expect(MenuItemResource::getCluster())->toBe(SettingsCluster::class)
        ->and(Route::has('filament.dashboard.settings.resources.menu-items.index'))->toBeTrue()
        ->and(route('filament.dashboard.settings.resources.menu-items.index', [], false))->toBe('/dashboard/settings/menu-items');
});

test('settings cluster menu item pages require dashboard authentication', function () {
    $this->get(route('filament.dashboard.settings.resources.menu-items.index'))
        ->assertRedirect(route('filament.dashboard.auth.login'));
});
