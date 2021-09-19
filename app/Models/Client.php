<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'identification_number',
        'telefono',
        'email'
    ];

    /**
     * 
     */
    public function orders(): HasMany
    {
        return $this->hasMany(OrderClient::class, 'client_id');
    }
}
