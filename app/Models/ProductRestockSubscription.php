<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductRestockSubscription extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'email',
    ];

    /**
     * The product that belongs to this subscription.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
