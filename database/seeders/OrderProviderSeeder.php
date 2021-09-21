<?php

namespace Database\Seeders;

use App\Models\OrderProvider;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderProvider::factory()
        ->count(20)
        ->create()
        ->each(function(OrderProvider $orderProvider){

            $products = Product::all()->take(5);

            $total_net_price = 0;
            $total_price = 0;
            $total_discount = 0;

            foreach($products as $product){

                $amount = random_int(12, 30);
                $net_price = $amount * $product->sell_price;
                $discount = ($net_price * (random_int(0, 10)/100));
                $price = $net_price - $discount;

                $orderProvider->products()->attach(
                    $product->id, [
                        'amount'        =>  $amount,
                        'price'         =>  $product->sell_price,
                        'discount'      =>  $discount,
                        'total_price'   =>  $price
                ]);

                $total_net_price += $net_price;
                $total_discount  += $discount;
                $total_price     += $price;

                $buyPrice = random_int(1000, 50000);
                $sellPrice = ($buyPrice * 0.2) + $buyPrice;
                $newAmount = $product->amoun + $amount;

                $product->update([
                    'buy_price' =>  $buyPrice,
                    'sell_price'=>  $sellPrice,
                    'stock'     =>  $newAmount  
                ]);
            }
            
            $orderProvider->update([
                'price'         =>  $total_net_price,
                'discount'      =>  $total_discount,
                'total_price'   =>  $total_price,
            ]);

        });
    }
}
