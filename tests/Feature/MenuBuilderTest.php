<?php

use App\Models\User;
use Filament\Support\Enums\Width;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use LaravelMcpDemo\MenuBuilder\Filament\Pages\MenuBuilder as MenuBuilderPage;
use LaravelMcpDemo\MenuBuilder\Livewire\MenuBuilder;
use LaravelMcpDemo\MenuBuilder\Models\MenuItem;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('menu builder page is registered in the dashboard panel', function () {
    expect(MenuBuilderPage::getCluster())->toBeNull()
        ->and(Route::has('filament.dashboard.pages.menu-builder'))->toBeTrue()
        ->and(route('filament.dashboard.pages.menu-builder', [], false))->toBe('/dashboard/menu-builder');
});

test('menu builder page uses full dashboard content width', function () {
    expect(app(MenuBuilderPage::class)->getMaxContentWidth())->toBe(Width::Full);
});

test('menu builder page requires dashboard authentication', function () {
    $this->get(route('filament.dashboard.pages.menu-builder'))
        ->assertRedirect(route('filament.dashboard.auth.login'));
});

test('menu builder livewire actions honor the configured authorization gate', function () {
    config()->set('menu-builder.authorization.ability', 'manage-menu-builder');

    Gate::define('manage-menu-builder', fn (User $user): bool => false);

    $this->actingAs(User::factory()->create());

    $this->get(route('filament.dashboard.pages.menu-builder'))
        ->assertForbidden();
});

test('menu builder creates updates and deletes menu items', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(MenuBuilder::class)
        ->call('createRootItem')
        ->set('form.label', 'Dokumentation')
        ->set('form.slug', 'dokumentation')
        ->set('form.view', 'pages.dynamic')
        ->set('form.is_active', true)
        ->call('saveSelectedMenuItem')
        ->assertHasNoErrors();

    $menuItem = MenuItem::query()->where('slug', 'dokumentation')->firstOrFail();

    expect($menuItem->label)->toBe('Dokumentation')
        ->and($menuItem->route_name)->toBe('dokumentation')
        ->and($menuItem->view)->toBe('pages.dynamic')
        ->and($menuItem->is_active)->toBeTrue();

    Livewire::test(MenuBuilder::class)
        ->call('selectMenuItem', $menuItem->id)
        ->call('deleteSelectedMenuItem');

    expect(MenuItem::query()->whereKey($menuItem->id)->exists())->toBeFalse();
});

test('menu builder links active selected items in a new window', function () {
    $this->actingAs(User::factory()->create());

    $menuItem = MenuItem::factory()->create([
        'label' => 'Dokumentation',
        'slug' => 'docs',
        'route_name' => 'docs.index',
        'view' => 'pages.dynamic',
        'is_active' => true,
    ]);

    Livewire::test(MenuBuilder::class)
        ->call('selectMenuItem', $menuItem->id)
        ->assertSee('Seite in neuem Fenster öffnen')
        ->assertSee('target="_blank"', false)
        ->assertSee('href="'.route('docs.index').'"', false);
});

test('menu builder validates that blade views exist', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(MenuBuilder::class)
        ->call('createRootItem')
        ->set('form.view', 'pages.missing-view')
        ->call('saveSelectedMenuItem')
        ->assertHasErrors(['form.view']);

    View::addNamespace('blog', resource_path('views'));

    Livewire::test(MenuBuilder::class)
        ->call('createRootItem')
        ->set('form.label', 'Package Demo')
        ->set('form.slug', 'package-demo')
        ->set('form.view', 'blog::pages.demo')
        ->call('saveSelectedMenuItem')
        ->assertHasNoErrors();
});

test('menu builder preserves slash as the root slug', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test(MenuBuilder::class)
        ->call('createRootItem')
        ->set('form.label', 'Home')
        ->set('form.slug', '/')
        ->set('form.view', 'home')
        ->call('saveSelectedMenuItem')
        ->assertHasNoErrors();

    expect(MenuItem::query()->where('slug', '/')->exists())->toBeTrue();
});

test('menu builder reorders items and can move them below another parent', function () {
    $this->actingAs(User::factory()->create());

    $parent = MenuItem::factory()->create([
        'label' => 'Produkte',
        'slug' => 'products',
        'sort_order' => 0,
    ]);

    $first = MenuItem::factory()->create([
        'label' => 'Leistungen',
        'slug' => 'services',
        'sort_order' => 10,
    ]);

    $second = MenuItem::factory()->create([
        'label' => 'Kontakt',
        'slug' => 'contact',
        'sort_order' => 20,
    ]);

    Livewire::test(MenuBuilder::class)
        ->call('moveMenuItem', $first->id, 1, 'root')
        ->call('moveMenuItem', $second->id, 0, $parent->id);

    expect($parent->fresh()->parent_id)->toBeNull()
        ->and($second->fresh()->parent_id)->toBe($parent->id)
        ->and($second->fresh()->sort_order)->toBe(0)
        ->and($first->fresh()->sort_order)->toBe(10);
});

test('menu builder rejects parent cycles', function () {
    $this->actingAs(User::factory()->create());

    $parent = MenuItem::factory()->create([
        'label' => 'Produkte',
        'slug' => 'products',
    ]);

    $child = MenuItem::factory()->childOf($parent)->create([
        'label' => 'Hardware',
        'slug' => 'products/hardware',
    ]);

    Livewire::test(MenuBuilder::class)
        ->call('selectMenuItem', $parent->id)
        ->set('form.parent_id', $child->id)
        ->call('saveSelectedMenuItem')
        ->assertHasErrors(['form.parent_id']);

    expect($parent->fresh()->parent_id)->toBeNull();
});
