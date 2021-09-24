<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Model;
use App\Models\OrderClient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderClient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $clients = Client::all()->pluck('id');
        $seller = User::role('seller')->get()->pluck('id');

        return [
            'client_id'         =>  $clients->random(),
            'seller_id'         =>  $seller->random(),
            'order_state_id'    =>  2,
        ];
    }
}
