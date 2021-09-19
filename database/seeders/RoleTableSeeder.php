<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PAll = Permission::create(['name'=>'*']);
        $Psell = Permission::create(['name' => 'sell']);
        $PproductCreate = Permission::create(['name' => 'product create']);
        $PproductEdit = Permission::create(['name' => 'product edit']);
        $PorderList = Permission::create(['name' => 'order list']);
        $PorderEdit = Permission::create(['name' => 'order edit']);
        
        //
        $rolAdmin = Role::create(['name'=>'admin']);
        $rolAdmin->givePermissionTo($PAll);

        // 
        $rolSeller = Role::create(['name'=>'seller']);
        $rolSeller->givePermissionTo($Psell);
        $rolSeller->givePermissionTo($PorderList);
        $rolSeller->givePermissionTo($PproductEdit);
    }
}
