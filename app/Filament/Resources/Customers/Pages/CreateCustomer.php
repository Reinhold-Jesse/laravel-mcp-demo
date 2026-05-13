<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Concerns\InteractsWithClusterFullContentWidth;
use App\Filament\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    use InteractsWithClusterFullContentWidth;

    protected static string $resource = CustomerResource::class;
}
