<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class driversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('drivers')->insert([
            
                'license_number' => 'D1234567',
                'license_img' => 'https://example.com/license.jpg',
        
        ]);
    }
}
