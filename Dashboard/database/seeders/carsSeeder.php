<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\car;

class carsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('cars')->insert([
                'brand_id' => 1,
                'model' => 'Corolla',
                'year' => 2020,
                'color' => 'White',
                'license_plate' => 'ABC-1234',
                'mileage' => 15000,
                'lat' => 40.7128,
                'lng' => -74.0060,
                'is_premium' => 100.00,
                'rental_count' => 0,
                'daily_rate' => 20.00,
                'status' => 'available',
        ]);
        $dato = new car();
        $dato->brand_id = 1;
        $dato->model = 'Corolla';
        $dato->year = 2020;
        $dato->color = 'White';
        $dato->license_plate = 'ABC-1234';
        $dato->mileage = 15000;
        $dato->lat = 40.7128;
        $dato->lng = -74.0060;
        $dato->is_premium = 100.00;
        $dato->rental_count = 0;
        $dato->daily_rate = 20.00;
        $dato->status = 'available';
        $dato->save();
    }
}
