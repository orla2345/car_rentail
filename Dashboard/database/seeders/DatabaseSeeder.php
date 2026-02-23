<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
  public function run(): void
{
   
    $this->call(loyalty_levelsSeeder::class);
    $this->call(brandsSeeder::class);

 
    $this->call(UsersSeeder::class); 
    $this->call(carsSeeder::class);  

    
    $this->call(driversSeeder::class);
    $this->call(rentalsSeeder::class); 
}
}
