<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelMcpDemo\MenuBuilder\Database\Seeders\MenuItemSeeder;

uses(RefreshDatabase::class);

test('the application returns a successful response', function () {
    $this->seed(MenuItemSeeder::class);

    $response = $this->get('/');

    $response->assertSuccessful();
});
