<?php

namespace Database\Seeders;

use App\Models\CashRegister;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DefaultDataSeeder extends Seeder
{
    public function run()
    {
        $this->createDefaultUsers();
        $this->createMoreData();
    }

    protected function createDefaultUsers()
    {
        if (! User::where('email', 'super@laravel.io')->exists()) {
            $admin = User::create([
                'email' => 'super@laravel.io',
                'name' => 'Super Admin',
                'is_active' => true,
                'password' => '123456',
            ]);

            $admin->syncRoles([Role::ROLE_SUPER_ADMIN]);
        }

        if (! User::where('email', 'admin@laravel.io')->exists()) {
            $user = User::create([
                'email' => 'admin@laravel.io',
                'name' => 'Admin',
                'is_active' => true,
                'password' => '123456',
            ]);

            $user->syncRoles([Role::ROLE_ADMIN]);
        }
    }

    protected function createMoreData()
    {
        User::factory(8)->create()->each(
            function ($user) {
                $user->assignRole('User');
            }
        );

        CashRegister::create(['description' => 'Caja 01', 'user_id' => 1]);
        CashRegister::create(['description' => 'Caja 02', 'user_id' => 2]);
        CashRegister::create(['description' => 'Caja 03', 'user_id' => 3]);
        CashRegister::create(['description' => 'Caja 04', 'user_id' => 4]);

        Product::create(['description' => 'Intermex', 'price' => 0]);
        Product::create(['description' => 'rural', 'price' => 0]);
        Product::create(['description' => 'Deposito Gyt', 'price' => 0]);
        Product::create(['description' => 'DEOCSA', 'price' => 0]);
        Product::create(['description' => 'INDUSTRIAL', 'price' => 0]);
        Product::create(['description' => 'G&T', 'price' => 0]);
        Product::create(['description' => 'Western', 'price' => 0]);
        Product::create(['description' => 'Sigue', 'price' => 0]);
        Product::create(['description' => 'retiro', 'price' => 0]);
        Product::create(['description' => 'rec Nexcel', 'price' => 0]);
        Product::create(['description' => 'Dep BI', 'price' => 0]);

        /* CashRegisterDetail::create(
            [
                'opening' => Carbon::now(),
                'initial_balance' => 150,
                'status' => 'open',
                'cash_register_id' => 1,
            ]
        );
        Movement::factory(50)->create(); */
    }
}
