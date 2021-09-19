<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
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

        $userAdmin = User::create([
            'name'      => 'Luisa',
            'last_name' =>  'Ocoro',
            'email'     =>  'luisa@mail.com',
            'password'  =>  bcrypt('password'),
        ]);

        $userSeller = User::create([
            'name'      => 'Andres',
            'last_name' =>  'Ocoro',
            'email'     =>  'andres@mail.com',
            'password'  =>  bcrypt('password'),
        ]);

        $userAdmin->assignRole($rolAdmin);
        $userSeller->assignRole($rolSeller);
    }
}
