<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Sections = [
                "section_name"=> "Cat1",
                "Created_by"=> date('Y-m-d H:i:s'),
                'created_at' => now(),
                'updated_at'=> now(),
        ];
        DB::table('sections')->insert($Sections);
    }
}
