<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\user;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'img' => 'https://example.com/profile.jpg',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'loyalty_level_id' => 1,

        ]);
    $dato = new user();
    $dato->name = 'Admin';
    $dato->img = 'https://example.com/profile.jpg';
    $dato->email = 'admin1@example.com';
    $dato->password = Hash::make('12345678');
    $dato->loyalty_level_id = 1;
    $dato->save();  
    }
}
