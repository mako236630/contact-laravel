<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        \App\Models\Contact::factory(35)->create();

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
