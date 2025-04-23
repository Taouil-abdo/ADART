<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ResidentSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CategorySeeder::class,
            SupplierSeeder::class,
            RoomSeeder::class,
            StockSeeder::class,
            ResidentSeeder::class,
        ]);

        User::create([
            'fullname' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin2025'), 
            'role_id' => 1, 
        ]);

        
    }
}
