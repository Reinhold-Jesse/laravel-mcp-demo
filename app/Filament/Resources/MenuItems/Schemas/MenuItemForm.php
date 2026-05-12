<?php

namespace App\Filament\Resources\MenuItems\Schemas;

use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use LaravelMcpDemo\MenuBuilder\Models\MenuItem;
use LaravelMcpDemo\MenuBuilder\Support\MenuBuilderViewResolver;

class MenuItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('parent_id')
                    ->label('Parent menu item')
                    ->options(fn (?MenuItem $record): array => MenuItem::query()
                        ->when($record, fn (Builder $query): Builder => $query->whereNotIn('id', self::excludedParentIds($record)))
                        ->orderBy('label')
                        ->pluck('label', 'id')
                        ->all())
                    ->rule(fn (?MenuItem $record): Closure => function (string $attribute, mixed $value, Closure $fail) use ($record): void {
                        if ($record === null || blank($value)) {
                            return;
                        }

                        if (in_array((int) $value, self::excludedParentIds($record), true)) {
                            $fail('Ein Menüpunkt kann nicht sich selbst oder einem eigenen Kind untergeordnet werden.');
                        }
                    })
                    ->searchable()
                    ->preload(),
                TextInput::make('label')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state): void {
                        if (filled($get('slug'))) {
                            return;
                        }

                        $set('slug', Str::slug($state ?? ''));
                    }),
                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('view')
                    ->required()
                    ->rule(app(MenuBuilderViewResolver::class)->validationRule())
                    ->placeholder('pages.about oder blog::pages.index')
                    ->helperText('Der gespeicherte Wert muss auf eine vorhandene Blade View zeigen.')
                    ->maxLength(255),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required()
                    ->default(true),
            ]);
    }

    /**
     * @return array<int, int>
     */
    private static function excludedParentIds(MenuItem $record): array
    {
        return [
            (int) $record->getKey(),
            ...self::descendantIds($record),
        ];
    }

    /**
     * @return array<int, int>
     */
    private static function descendantIds(MenuItem $record): array
    {
        return $record->children()
            ->get()
            ->flatMap(fn (MenuItem $child): array => [
                (int) $child->getKey(),
                ...self::descendantIds($child),
            ])
            ->all();
    }
}
