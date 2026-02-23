<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\driver;

class driversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('drivers')->insert([
            
                'license_number' => 'D1234567',
                'user_id' => 1,
                'license_img' => 'https://example.com/license.jpg',
        
        ]);
    $dato = new driver();
    $dato->license_number = 'D1234567';
    $dato->user_id = 1;
    $dato->license_img = 'https://example.com/license.jpg';
    $dato->save();
    }
}
