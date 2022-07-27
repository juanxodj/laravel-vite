<?php

namespace Database\Seeders;

use App\Models\CashRegister;
use App\Models\CashRegisterDetail;
use App\Models\Movement;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
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

        Product::create(['description' => 'Intermex', 'price' => 0]);
        Product::create(['description' => 'rural', 'price' => 0]);
        Product::create(['description' => 'Depósito Gyt', 'price' => 0]);
        Product::create(['description' => 'DEOCSA', 'price' => 0]);
        Product::create(['description' => 'INDUSTRIAL', 'price' => 0]);
        Product::create(['description' => 'G&T', 'price' => 0]);
        Product::create(['description' => 'Western', 'price' => 0]);
        Product::create(['description' => 'Sigue', 'price' => 0]);
        Product::create(['description' => 'retiro', 'price' => 0]);
        Product::create(['description' => 'rec Nexcel', 'price' => 0]);
        Product::create(['description' => 'Dep BI', 'price' => 0]);

        CashRegisterDetail::create(
            [
                'opening' => Carbon::now(),
                'initial_balance' => 150,
                'status' => 'open',
                'cash_register_id' => 1,
            ]
        );

        Movement::factory(50)->create();
    }
}
