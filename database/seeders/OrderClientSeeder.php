<?php

namespace Database\Seeders;

use App\Models\OrderClient;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderClient::factory()
        ->count(20)
        ->create()
        ->each(function(OrderClient $orderClient){

            $products = Product::all()->take(5);
            $data = array();
            
            $total_net_price = 0;
            $total_price = 0;
            $total_discount = 0;

            foreach($products as $product){

                $amount = random_int(1, 5);
                $net_price = $amount * $product->sell_price;
                $discount = ($net_price * (random_int(0, 30)/100));
                $price = $net_price - $discount;

                $orderClient->products()->attach(
                    $product->id, [
                        'amount'        =>  $amount,
                        'price'         =>  $product->sell_price,
                        'discount'      =>  $discount,
                        'total_price'   =>  $price
                ]);

                $total_net_price += $net_price;
                $total_discount  += $discount;
                $total_price     += $price;
            }

            
            $orderClient->update([
                'price'         =>  $total_net_price,
                'discount'      =>  $total_discount,
                'total_price'   =>  $total_price,
            ]);
        });
    }
}
