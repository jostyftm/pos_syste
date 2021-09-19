<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Seeder;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderState::create([
            'name'  =>  'completado'
        ]);
        
        OrderState::create([
            'name'  =>  'cancelado'
        ]);
        
        OrderState::create([
            'name'  =>  'devuelto'
        ]);
    }
}
