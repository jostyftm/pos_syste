<?php

namespace Database\Seeders;

use App\Models\OrderClient;
use App\Models\Product;
use Carbon\Carbon;
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
        $this->monthSell();
        $this->dailySells();
    }

    public function monthSell()
    {
        OrderClient::factory()
        ->count(50)
        ->create()
        ->each(function(OrderClient $orderClient){

            $date = Carbon::now();
            $products = Product::all()->take(5);
            
            $total_net_price = 0;
            $total_price = 0;
            $total_discount = 0;

            foreach($products as $product){

                $amount = random_int(1, 5);
                $net_price = $amount * $product->sell_price;
                $discount = 0;
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
                'created_at'    =>  $date->subMonths(random_int(1, 8))
            ]);
        });
    }

    public function dailySells()
    {
        OrderClient::factory()
        ->count(50)
        ->create()
        ->each(function(OrderClient $orderClient){

            $date = Carbon::now();
            $products = Product::all()->take(5);
            
            $total_net_price = 0;
            $total_price = 0;
            $total_discount = 0;

            foreach($products as $product){

                $amount = random_int(1, 5);
                $net_price = $amount * $product->sell_price;
                $discount = 0;
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
                'created_at'    =>  $date->subDays(random_int(1, 15))
            ]);
        });
    }
}
