<?php

namespace Database\Factories;

use App\Models\OrderProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProviderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderProvider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'provider_id',
            'price',
            'discount',
            'total_price'
        ];
    }
}
