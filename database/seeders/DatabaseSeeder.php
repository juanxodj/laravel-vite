<?php

namespace Database\Seeders;

use App\Models\CashRegister;
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
        if (! User::where('email', 'admin@laravel.io')->exists()) {
            User::create([
                'email' => 'admin@laravel.io',
                'name' => 'Admin',
                'password' => '123456',
                'is_active' => true,
            ]);
        }
        User::factory(4)->create();

        /* \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        CashRegister::create(['description' => 'Caja 01']);
        CashRegister::create(['description' => 'Caja 02']);
        CashRegister::create(['description' => 'Caja 03']);
        CashRegister::create(['description' => 'Caja 04']);
    }
}
