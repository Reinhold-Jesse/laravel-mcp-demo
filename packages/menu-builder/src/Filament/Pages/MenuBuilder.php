<?php

namespace LaravelMcpDemo\MenuBuilder\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class MenuBuilder extends Page
{
    protected string $view = 'menu-builder::filament.pages.menu-builder';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBars3;

    protected static ?string $navigationLabel = 'Menü Builder';

    protected static ?int $navigationSort = 5;
}
