<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoice = [
            "invoice_number"=> "809706BNB",
            'product'=> 'Pro1',
            'section_id'=> 1,
            'amount_commission'=> 250.60,
            'discount'=> '0.00',
            'value_vat'=> 4.00,
            'rate_vat'=> '10%',
            'total'=> 50.62,
            'status'=> 'غير مدفوعة',
            'value_status'=> 1,
            'created_at'=> now(),
            'updated_at'=> now(),
        ];
        DB::table('invoices')->insert($invoice);
    }
}
