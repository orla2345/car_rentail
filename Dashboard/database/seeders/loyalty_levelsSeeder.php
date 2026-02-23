<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\loyalty_level;

class loyalty_levelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('loyalty_levels')->insert([
            
                'name' => 'Bronze',
                'min_points' => 0,
                'discount_percentage' => 0,
                'free_extra_hours' => 4,

        ]);
    $dato = new loyalty_level();
    $dato->name = 'Bronze';
    $dato->min_points = 0;
    $dato->discount_percentage = 0;
    $dato->free_extra_hours = 4;
    $dato->save(); 
    }
}
