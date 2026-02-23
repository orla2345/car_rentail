<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\rental;

class rentalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('rentals')->insert([
            
                'user_id' => 1,
                'car_id' => 1,
                'driver_id' => 1,
                'pickup_date' => '2024-07-01 10:00:00',
                'return_date' => '2024-07-05 10:00:00',
                'total_amount' => 100.00,
                'status' => 'completed',
        
        ]); 
    $dato = new rental();
    $dato->user_id = 1;
    $dato->car_id = 1;
    $dato->driver_id = 1;
    $dato->pickup_date = '2024-07-01 10:00:00';
    $dato->return_date = '2024-07-05 10:00:00';
    $dato->total_amount = 100.00;
    $dato->status = 'completed';
    $dato->save();
    }
}
