<?php

use App\Filament\Clusters\Settings\SettingsCluster;
use App\Filament\Resources\Customers\CustomerResource;
use App\Filament\Resources\Customers\Pages\ListCustomers;
use App\Models\User;
use Filament\Support\Enums\Width;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('customers are registered in the settings cluster', function () {
    expect(CustomerResource::getCluster())->toBe(SettingsCluster::class)
        ->and(Route::has('filament.dashboard.settings'))->toBeTrue()
        ->and(Route::has('filament.dashboard.settings.resources.customers.index'))->toBeTrue()
        ->and(route('filament.dashboard.settings', [], false))->toBe('/dashboard/settings')
        ->and(route('filament.dashboard.settings.resources.customers.index', [], false))->toBe('/dashboard/settings/customers');
});

test('settings cluster customer pages require dashboard authentication', function () {
    $this->get(route('filament.dashboard.settings.resources.customers.index'))
        ->assertRedirect(route('filament.dashboard.auth.login'));
});

test('settings cluster customer list uses full content width', function () {
    $this->actingAs(User::factory()->create());

    $component = Livewire::test(ListCustomers::class);

    expect($component->instance()->getMaxContentWidth())->toBe(Width::Full);
});
