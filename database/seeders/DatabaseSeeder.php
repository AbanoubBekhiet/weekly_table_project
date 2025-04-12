<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::create([
        //     "name"=>"abanoub",
        //     "password"=>Hash::make("123456"),
        //     "password_not_hashed"=>123456,
        //     "email"=>"abanoub@gmail.com",
        // ]);
        // Admin::create([
        //     "name"=>"abanoub",
        //     "password"=>Hash::make("123456"),
        //     "email"=>"abanoub@gmail.com",
        // ]);
        Admin::create([
            "name"=>"royal",
            "password"=>Hash::make("royal@9312"),
            "email"=>"royal@123",
        ]);
    }
}
