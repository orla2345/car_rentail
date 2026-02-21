<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'feree_extra_hours' => false,

        ]);
    }
}
