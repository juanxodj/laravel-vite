<?php

namespace Database\Seeders;

use App\Models\CashRegister;
use App\Models\Movement;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'admin@laravel.io')->exists()) {
            User::create([
                'email' => 'admin@laravel.io',
                'name' => 'Admin',
                'password' => '123456',
                'is_active' => true,
            ]);
        }
        User::factory(4)->create();

        CashRegister::create(['description' => 'Caja 01']);
        CashRegister::create(['description' => 'Caja 02']);
        CashRegister::create(['description' => 'Caja 03']);
        CashRegister::create(['description' => 'Caja 04']);

        Product::create(['description' => 'Producto 01', 'price' => 50]);
        Product::create(['description' => 'Producto 02', 'price' => 100]);
        Product::create(['description' => 'Producto 03', 'price' => 150]);
        Product::create(['description' => 'Producto 04', 'price' => 200]);
        Product::create(['description' => 'Producto 05', 'price' => 250]);

        Movement::factory(100)->create();
    }
}
