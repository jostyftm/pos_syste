<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProvider extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id',
        'price',
        'discount',
        'total_price'
    ];
}
