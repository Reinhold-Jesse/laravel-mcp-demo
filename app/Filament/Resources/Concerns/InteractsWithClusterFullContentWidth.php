<?php

namespace App\Filament\Resources\Concerns;

use Filament\Support\Enums\Width;

trait InteractsWithClusterFullContentWidth
{
    public function getMaxContentWidth(): Width|string|null
    {
        if (filled(static::getCluster())) {
            return Width::Full;
        }

        return parent::getMaxContentWidth();
    }
}
