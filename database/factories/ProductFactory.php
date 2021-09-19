<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $code = $this->faker->unique()->randomNumber(6);
        $slug = "producto-{$code}";
        $buyPrice = $this->faker->numberBetween(1000, 50000);
        return [
            'code'          =>  $code,
            'name'          =>  "producto {$code}",
            'slug'          =>  $slug,
            'description'   =>  $this->faker->text(20),
            'buy_price'     =>  $buyPrice,
            'sell_price'    =>  ($buyPrice * 0.2)+$buyPrice,
            'stock'         =>  $this->faker->numberBetween(0, 20)
        ];
    }
}
