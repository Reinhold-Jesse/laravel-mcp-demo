<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use LaravelMcpDemo\MenuBuilder\Database\Seeders\MenuItemSeeder;
use LaravelMcpDemo\MenuBuilder\Livewire\MenuNavigation;
use LaravelMcpDemo\MenuBuilder\Models\MenuItem;
use LaravelMcpDemo\MenuBuilder\Support\MenuItemRepository;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('package routes are database driven', function () {
    $defaults = require base_path('packages/menu-builder/config/menu-builder.php');

    expect($defaults)->not->toHaveKey('routes')
        ->and($defaults)->not->toHaveKey('views')
        ->and($defaults)->not->toHaveKey('fallback_view')
        ->and($defaults)->not->toHaveKey('home_slug');
});

test('active menu items resolve to dynamic pages', function () {
    $this->seed(MenuItemSeeder::class);

    $this->get('/products/hardware')
        ->assertSuccessful()
        ->assertSee('Hardware')
        ->assertSee('products/hardware')
        ->assertSee('pages.dynamic');

    $this->get('/services/audits')
        ->assertSuccessful()
        ->assertSee('Audits')
        ->assertSee('services/audits')
        ->assertSee('pages.dynamic');
});

test('root resolves through a slash slug stored in the database', function () {
    $this->seed(MenuItemSeeder::class);

    $this->get('/')
        ->assertSuccessful()
        ->assertSee('Void Studio');
});

test('home slug is not a special root alias', function () {
    $this->seed(MenuItemSeeder::class);

    $this->get('/home')->assertNotFound();
});

test('inactive or unknown menu slugs return not found', function () {
    MenuItem::factory()->create([
        'label' => 'Versteckt',
        'slug' => 'hidden',
        'view' => 'pages.hidden',
        'is_active' => false,
    ]);

    $this->get('/hidden')->assertNotFound();
    $this->get('/does-not-exist')->assertNotFound();
});

test('dynamic pages render the blade view stored on the menu item', function () {
    MenuItem::factory()->create([
        'label' => 'Welcome',
        'slug' => 'welcome-page',
        'view' => 'welcome',
        'is_active' => true,
    ]);

    $this->get('/welcome-page')
        ->assertSuccessful()
        ->assertSee("Let's get started", false)
        ->assertDontSee('Dynamische Menüseite');
});

test('dynamic pages render allowed app resource views', function () {
    MenuItem::factory()->create([
        'label' => 'Startseite',
        'slug' => 'startseite',
        'view' => 'home',
        'is_active' => true,
    ]);

    $this->get('/startseite')
        ->assertSuccessful()
        ->assertSee('Void Studio')
        ->assertDontSee('Dynamische Menüseite');
});

test('dynamic pages render views from known package namespaces', function () {
    View::addNamespace('menu-demo', resource_path('views'));

    MenuItem::factory()->create([
        'label' => 'Package Demo',
        'slug' => 'package-demo',
        'view' => 'menu-demo::pages.demo',
        'is_active' => true,
    ]);

    $this->get('/package-demo')
        ->assertSuccessful()
        ->assertSee('Dynamische Menü-Navigation')
        ->assertDontSee('Dynamische Menüseite');
});

test('dynamic pages return not found when the stored blade view is missing', function () {
    MenuItem::factory()->create([
        'label' => 'Missing View',
        'slug' => 'missing-view',
        'view' => 'pages.missing-view',
        'is_active' => true,
    ]);

    $this->get('/missing-view')->assertNotFound();
});

test('menu navigation renders active menu entries', function () {
    $parent = MenuItem::factory()->create([
        'label' => 'Produkte',
        'slug' => 'products',
        'sort_order' => 0,
    ]);

    MenuItem::factory()->childOf($parent)->create([
        'label' => 'Hardware',
        'slug' => 'products/hardware',
        'sort_order' => 0,
    ]);

    MenuItem::factory()->create([
        'label' => 'Versteckt',
        'slug' => 'hidden',
        'is_active' => false,
    ]);

    Livewire::test(MenuNavigation::class)
        ->assertSee('Produkte')
        ->assertSee('Hardware')
        ->assertDontSee('Versteckt')
        ->assertSee('/products/hardware');
});

test('menu navigation links slash slug to the root url', function () {
    MenuItem::factory()->create([
        'label' => 'Home',
        'slug' => '/',
        'sort_order' => 0,
    ]);

    Livewire::test(MenuNavigation::class)
        ->assertSee('Home')
        ->assertSee('href="'.url('/').'"', false);
});

test('menu item repository recovers from stale invalid cached navigation data', function () {
    $menuItem = MenuItem::factory()->create([
        'label' => 'Produkte',
        'slug' => 'products',
        'sort_order' => 0,
    ]);

    Cache::put(config('menu-builder.cache.key'), 'stale-invalid-cache-value');

    $activeItems = app(MenuItemRepository::class)->activeItems();

    expect($activeItems)->toHaveCount(1)
        ->and($activeItems->first()->is($menuItem))->toBeTrue()
        ->and(Cache::get(config('menu-builder.cache.key')))->toBeArray();
});

test('demo page is rendered from a menu item', function () {
    MenuItem::factory()->create([
        'label' => 'Demo',
        'slug' => 'demo',
        'view' => 'pages.demo',
        'sort_order' => 0,
    ]);

    MenuItem::factory()->create([
        'label' => 'Produkte',
        'slug' => 'products',
        'sort_order' => 10,
    ]);

    $this->get('/demo')
        ->assertSuccessful()
        ->assertSee('Dynamische Menü-Navigation')
        ->assertSee('Produkte')
        ->assertSee('livewire:menu-builder.navigation');
});
