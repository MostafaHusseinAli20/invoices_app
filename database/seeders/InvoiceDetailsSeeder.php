<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoice_detail = [
            "id_Invoice"=> 1,
            "invoice_number"=> "809706BNB",
            'product'=> 'Pro1',
            'Section'=> 'Cat1',
            'status'=> 'غير مدفوعة',
            'value_status'=> 1,
            'user' => 'Admin',
            'created_at'=> now(),
            'updated_at'=> now(),
        ];
        DB::table('invoices__details')->insert($invoice_detail);
    }
}
