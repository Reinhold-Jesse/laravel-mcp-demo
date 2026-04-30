<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'stock_quantity',
        'is_active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Restock notification subscriptions linked to this product.
     */
    public function restockSubscriptions(): HasMany
    {
        return $this->hasMany(ProductRestockSubscription::class);
    }
}
