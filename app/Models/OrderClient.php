<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderClient extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'seller_id',
        'order_state_id',
        'price',
        'discount',
        'total_price',
    ];

    /**
     * 
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * 
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(OrderState::class, 'order_state_id');
    }

    /**
     * 
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * 
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'client_order_items', 'order_id', 'product_id')
        ->using(ClientOrderItem::class);
    }
}
