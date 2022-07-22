<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

    \App\Models\User::factory(4)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
  }
}
