<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class paymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('payments')->insert([
            
                'rental_id' => 1,
                'amount' => 100.00,
                'payment_method' => 'credit_card',
                'transaction_id' => 'TXN123456789',
                'payment_status' => 'completed',
        
        ]);
    }
}
