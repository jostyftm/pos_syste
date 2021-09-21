<?php

namespace Database\Seeders;

use App\Models\OrderProvider;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seeds attribute
     *
     *  @var array 
     */
    private $seeds = [
        'migrate',
        'users',
        'orderState',
        'products',
        'provider',
        'orderProvider',
        'client',
        'orderClient'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->seeds as $seed) {
            $this->command->line("Processing {$seed}");
            call_user_func([$this, $seed]);
        }
    }

    /**
     * Refresh databases
     */
    public function migrate()
    {
        $this->command->call('key:generate');
        $this->command->call('migrate:refresh');
        $this->command->line('Migrated tables.');
    }

    /**
     * 
     */
    public function users()
    {
        $this->call(UserTableSeeder::class);
    }

    /**
     * 
     */
    public function products()
    {
        $this->call(ProductSeeder::class);
    }
    
    /**
     * 
     */
    public function orderState()
    {
        $this->call(OrderStateSeeder::class);
    }    

    /**
     * 
     */
    public function client()
    {
        $this->call(ClientSeeder::class);
    }

    /**
     * 
     */
    public function orderClient()
    {
        $this->call(OrderClientSeeder::class);
    }

    /**
     * 
     */
    public function provider()
    {
        $this->call(ProviderSeeder::class);
    }

    /**
     * 
     */
    public function orderProvider()
    {
        $this->call(OrderProviderSeeder::class);
    }
}
