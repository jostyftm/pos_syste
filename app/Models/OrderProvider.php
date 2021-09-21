<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'order_state_id',
        'price',
        'discount',
        'total_price'
    ];

    /**
     * 
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'provider_order_items', 'order_id', 'product_id')
        ->using(ProviderOrderItem::class);
    }
}
