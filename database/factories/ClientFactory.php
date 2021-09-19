<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'                      =>  $this->faker->name,
            'last_name'                 =>  $this->faker->lastName,
            'identification_number'     =>  $this->faker->numberBetween(100000, 1000000),
            'telefono'                  =>  $this->faker->phoneNumber,
            'email'                     =>  $this->faker->unique()->safeEmail
        ];
    }
}
