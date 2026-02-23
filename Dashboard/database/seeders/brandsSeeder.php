<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\brand;

class brandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('brands')->insert([
            
                'name' => 'Toyota',
                'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Toyota_logo.png/1200px-Toyota_logo.png'
    ]);
    $dato = new brand();
    $dato->name = 'Toyota';
    $dato->img = 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Toyota_logo.png/1200px-Toyota_logo.png';
    $dato->save();

    }
}
