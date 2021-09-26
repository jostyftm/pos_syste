<?php

namespace App\Traits;

use App\Models\Product;
use Illuminate\Http\Request;

trait HasProducts {

    public function addProduct(Request $request, Product $product)
    {
        $newAmount = $this->verifyProduct($product, $request->amount);
        
        if($newAmount == 0) {

            $this->products()->attach($product->id, [
                'amount'        =>  $request->amount,
                'price'         =>  $product->sell_price,
                'discount'      =>  0,
                'total_price'   =>  ($product->sell_price * $request->amount)
            ]);
        }else {
            $this->updateValueItem($product, $newAmount);
        }
    }

    public function updateValueItem(Product $product, $amount)
    {
        $this->products()->updateExistingPivot($product->id,[
            'amount' => $amount
        ]);
    }

    public function removeProduct(Product $product)
    {
        $this->products()->detach($product->id);
    }

    public function verifyProduct(Product $product, $amount)
    {
        $newAmount = 0;

        foreach($this->products as $p)
        {
            if($p->id === $product->id){
                $newAmount = ($p->pivot->amount + $amount);
                break;
            }
        }

        return $newAmount;
    }
}