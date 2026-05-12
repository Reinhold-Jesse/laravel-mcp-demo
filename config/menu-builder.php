<?php

use LaravelMcpDemo\MenuBuilder\Models\MenuItem;

return [
    'panel_id' => 'dashboard',

    'model' => MenuItem::class,

    'authorization' => [
        'enabled' => true,
        'ability' => null,
    ],

    'assets' => [
        'vite' => [
            'resources/css/app.css',
            'resources/js/app.js',
        ],
    ],

    'cache' => [
        'enabled' => true,
        'key' => 'menu-builder.active-items',
        'ttl' => 300,
        'table_exists_key' => 'menu-builder.table-exists',
    ],

    'database' => [
        'check_table_exists' => true,
    ],

    'livewire' => [
        'builder_alias' => 'menu-builder.builder',
        'navigation_alias' => 'menu-builder.navigation',
        'register_legacy_aliases' => false,
    ],
];
