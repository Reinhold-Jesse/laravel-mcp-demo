<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Concerns\InteractsWithClusterFullContentWidth;
use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProduct extends ViewRecord
{
    use InteractsWithClusterFullContentWidth;

    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
