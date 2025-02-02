<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionAdminSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(InvoicesSeeder::class);
        $this->call(InvoiceDetailsSeeder::class);
    }
}
