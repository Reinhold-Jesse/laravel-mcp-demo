# Laravel MCP Demo Menu Builder

Reusable Filament + Livewire menu builder for Laravel applications.

This package provides:

- A Filament admin page for managing a hierarchical menu tree.
- Drag-and-drop sorting with Livewire.
- Dynamic frontend routing based on stored menu slugs.
- A Livewire navigation component for rendering active menu items.
- A default `MenuItem` model, migration, factory, and demo seeder.
- Package views for the builder UI; frontend page views live in the host app or known packages.

The package is currently installed in this project as a local Composer path package:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "packages/menu-builder",
            "options": {
                "symlink": true
            }
        }
    ],
    "require": {
        "laravel-mcp-demo/menu-builder": "*"
    }
}
```

For a production deployment, either commit the `packages/menu-builder` directory with the application or move the package to a VCS/Composer repository and require that source instead of relying on a local path that may be missing on the server.

## Requirements

- PHP `^8.3`
- Laravel `^13.0`
- Filament `^5.6`
- Livewire `^4.3`

## Installation

For this local project, install or refresh the package with:

```bash
composer update laravel-mcp-demo/menu-builder --with-dependencies
```

Then rebuild autoload files if needed:

```bash
composer dump-autoload
```

The package is auto-discovered by Laravel through its `composer.json` provider registration:

```json
"extra": {
    "laravel": {
        "providers": [
            "LaravelMcpDemo\\MenuBuilder\\MenuBuilderServiceProvider"
        ]
    }
}
```

## Configuration

The default package config lives at:

```text
packages/menu-builder/config/menu-builder.php
```

Current defaults:

```php
return [
    'panel_id' => 'dashboard',

    'model' => LaravelMcpDemo\MenuBuilder\Models\MenuItem::class,

    'authorization' => [
        'enabled' => true,
        'ability' => null,
    ],

    'assets' => [
        'vite' => [],
    ],

    'cache' => [
        'enabled' => true,
        'key' => 'menu-builder.active-items',
        'ttl' => 300,
        'table_exists_key' => 'menu-builder.table-exists',
    ],

    'database' => [
        'check_table_exists' => false,
    ],

    'livewire' => [
        'builder_alias' => 'menu-builder.builder',
        'navigation_alias' => 'menu-builder.navigation',
        'register_legacy_aliases' => false,
    ],
];
```

To publish the config into the host app:

```bash
php artisan vendor:publish --tag=menu-builder-config
```

After publishing, edit:

```text
config/menu-builder.php
```

### Config Options

`panel_id`

The Filament panel ID where the admin page should be registered. In this app the dashboard panel has ID `dashboard`, so the builder appears in that panel.

`model`

The Eloquent model used for menu records. By default the package uses `LaravelMcpDemo\MenuBuilder\Models\MenuItem`, but the host app can override this with its own model as long as it supports the columns described below.

`authorization.enabled`

When `true`, the package protects the Livewire builder component itself, not only the Filament route around it.

`authorization.ability`

Optional Gate ability used for menu management. When this is `null`, the package requires an authenticated user. For production panels, configure a real ability such as `manage-menu-builder`.

`assets.vite`

Optional host Vite entries included by package fallback/demo pages. Leave empty if the host app provides its own layout or publishes the views.

`cache.*`

Controls caching for public navigation data and the optional table-existence check.

`database.check_table_exists`

When `true`, the dynamic controller caches a table-existence check before querying menu items. Keep this off in production if migrations are guaranteed, and enable it for demo/local bootstrapping.

`livewire.*`

Controls the registered Livewire aliases. The package uses prefixed aliases by default to avoid collisions with host components.

## Model, Migration, And Table Shape

The package ships with this default model:

```php
LaravelMcpDemo\MenuBuilder\Models\MenuItem
```

The package also loads its own migration for the `menu_items` table. If you override `model`, the configured model/table must provide these fields:

```php
$table->id();
$table->foreignId('parent_id')->nullable();
$table->string('label');
$table->string('slug')->unique();
$table->string('view');
$table->unsignedInteger('sort_order')->default(0);
$table->boolean('is_active')->default(true);
$table->timestamps();
```

Recommended indexes:

```php
$table->index(['parent_id', 'sort_order']);
$table->index('is_active');
```

The default `MenuItem` model defines `parent`, `children`, and `active()` so it can be used directly in tests, seeders, Filament resources, or host application code.

## Filament Admin Usage

The package registers a Filament page automatically for the configured panel:

```text
/dashboard/menu-builder
```

The page class is:

```php
LaravelMcpDemo\MenuBuilder\Filament\Pages\MenuBuilder
```

The page renders the package Livewire component:

```php
LaravelMcpDemo\MenuBuilder\Livewire\MenuBuilder
```

The builder UI supports:

- Selecting a menu item from the tree.
- Creating root items.
- Creating child items.
- Editing `label`, `parent_id`, `slug`, `view`, and `is_active`.
- Regenerating a slug from the label and parent.
- Deleting an item.
- Drag-and-drop sorting via Livewire `wire:sort`.
- Moving items between parent groups.

## Dynamic Frontend Routing

The package registers its frontend routes inside the package service provider:

```php
Route::get('/', DynamicPageController::class)
    ->defaults('menuBuilderSlug', '/')
    ->name('menu-builder.pages.root');

Route::fallback(DynamicPageController::class)
    ->name('menu-builder.pages.show');
```

All frontend pages are resolved from active `menu_items` records. The root URL `/` exists when a matching menu item with slug `/` exists in the database. There is no static demo route; `/demo` only exists when a menu item with slug `demo` exists.

### How URL Resolution Works

For a request like:

```text
/products/hardware
```

The package searches the configured model for:

```php
slug = 'products/hardware'
is_active = true
```

For the root URL `/`, the package searches for:

```php
slug = '/'
is_active = true
```

If found, it reads the record's `view` column.

If the stored Blade view exists, it is rendered:

```php
view($menuItem->view)
```

If the stored Blade view does not exist, the response is `404`.

The rendered view receives:

```php
[
    'menuItem' => $menuItem,
    'pageTitle' => $menuItem->label,
]
```

If no active menu item exists for the requested slug, the response is `404`.

## Creating Pages

Each menu item has a `view` value such as:

```text
pages.products.hardware
```

To create a custom page for that item, add:

```text
resources/views/pages/products/hardware.blade.php
```

To point a menu item at a page from another package, store the registered namespaced view on the menu item:

```text
blog::pages.index
```

Example:

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $pageTitle }}</title>

        @vite(config('menu-builder.assets.vite'))
    </head>
    <body>
        <livewire:menu-builder.navigation />

        <main>
            <h1>{{ $menuItem->label }}</h1>
            <p>Custom content for {{ $menuItem->slug }}.</p>
        </main>
    </body>
</html>
```

Until the custom Blade view exists, the package fallback page is used automatically.

## Livewire Navigation Component

The package registers this Livewire component:

```blade
<livewire:menu-builder.navigation />
```

Class:

```php
LaravelMcpDemo\MenuBuilder\Livewire\MenuNavigation
```

View:

```text
packages/menu-builder/resources/views/livewire/menu-navigation.blade.php
```

The component:

- Loads active menu items.
- Builds a nested tree from `parent_id`.
- Renders root items and dropdown children.
- Links `/` to the root URL.
- Links all other slugs to `/{slug}`.
- Ignores inactive menu items.

Example usage in any Blade file:

```blade
<header>
    <livewire:menu-builder.navigation />
</header>
```

## Demo Page

This project includes a simple app-level demo page:

```text
resources/views/pages/demo.blade.php
```

To open it at:

```text
/demo
```

create an active menu item with:

```text
slug = demo
view = pages.demo
```

The page renders:

```blade
<livewire:menu-builder.navigation />
```

Use it to quickly confirm that active menu items are rendered as frontend navigation.

## Publishing Views

To publish package views into the application:

```bash
php artisan vendor:publish --tag=menu-builder-views
```

Published views will be copied to:

```text
resources/views/vendor/menu-builder
```

Use this if you want to customize the package UI without editing files inside `packages/menu-builder`.

## Styling And Tailwind

The package views use Tailwind CSS utility classes.

In this app, `resources/css/app.css` includes the package view source:

```css
@source '../../packages/menu-builder/resources/views/**/*.blade.php';
```

The Filament dashboard theme also scans package views:

```css
@source '../../../../packages/menu-builder/resources/views/**/*.blade.php';
```

After changing package views or Tailwind classes, rebuild assets:

```bash
npm run build
```

For development:

```bash
npm run dev
```

## Seeded Menu Data

The package includes a `MenuItemSeeder` that creates a nested navigation structure with entries such as:

```text
/
products
products/hardware
services
services/audits
company/about
support/downloads
```

Run seeders as usual:

```bash
php artisan db:seed
```

In a host app seeder, call the package seeder like this:

```php
use LaravelMcpDemo\MenuBuilder\Database\Seeders\MenuItemSeeder;

$this->call([
    MenuItemSeeder::class,
]);
```

Or run a full refresh during development:

```bash
php artisan migrate:fresh --seed
```

## Testing

Relevant tests in this app:

```text
tests/Feature/MenuBuilderTest.php
tests/Feature/DynamicMenuRoutingTest.php
tests/Feature/MenuItemTest.php
```

Run focused tests:

```bash
php artisan test --compact tests/Feature/DynamicMenuRoutingTest.php tests/Feature/MenuBuilderTest.php tests/Feature/MenuItemTest.php
```

Typical assertions cover:

- The Filament builder page is registered.
- The builder can create, update, delete, and sort menu items.
- The builder rejects authorization failures and parent cycles.
- Dynamic slugs resolve to frontend pages.
- Dynamic pages only render existing Blade views.
- Unknown or inactive slugs return `404`.
- `<livewire:menu-builder.navigation />` renders active items only.

## Troubleshooting

### The menu builder does not appear in Filament

Check that `panel_id` matches your Filament panel:

```php
'panel_id' => 'dashboard',
```

Also clear cached Filament components/routes if needed:

```bash
php artisan filament:clear-cached-components
php artisan route:clear
php artisan optimize:clear
```

### The frontend route returns 404

Check that:

- The menu item exists.
- `slug` matches the URL without a leading slash, or is `/` for the root URL.
- `is_active` is `true`.
- The stored `view` points to an existing Blade view.

### The page returns 404 instead of rendering my custom view

Check that the `view` value maps to a real Blade file.

For example:

```text
pages.products.hardware
```

requires:

```text
resources/views/pages/products/hardware.blade.php
```

### Navigation styles are missing

Rebuild frontend assets:

```bash
npm run build
```

Ensure your Tailwind CSS source includes the package views.

### The package cannot query menu items

Ensure migrations have run and that the configured model/table exists:

```bash
php artisan migrate
```

If you use a custom model, update:

```php
'model' => App\Models\YourMenuItem::class,
```

The custom model must expose the required columns listed above.
