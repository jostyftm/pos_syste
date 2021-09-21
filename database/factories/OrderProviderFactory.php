<?php

namespace Database\Factories;

use App\Models\OrderProvider;
use App\Models\Provider;
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
        $providers = Provider::all()->pluck('id');

        return [
            'provider_id'    => $providers->random(),
            'order_state_id' => 1
        ];
    }
}
