<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Concerns\InteractsWithClusterFullContentWidth;
use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    use InteractsWithClusterFullContentWidth;

    protected static string $resource = ProductResource::class;
}
