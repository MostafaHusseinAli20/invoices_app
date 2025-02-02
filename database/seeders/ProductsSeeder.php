<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            "product_name"=> "Pro1",
            "section_id"=> 1,
            'created_at' => now(),
            'updated_at'=> now(),
    ];
    DB::table('products')->insert($products);
    }
}
