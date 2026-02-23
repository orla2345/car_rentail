<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\payment;

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
    $dato = new payment();
    $dato->rental_id = 1;
    $dato->amount = 100.00;
    $dato->payment_method = 'credit_card';
    $dato->transaction_id = 'TXN123456789';
    $dato->payment_status = 'completed';
    $dato->save();
    }
}
