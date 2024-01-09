<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Product::truncate();

        Product::factory()
            ->count(50)
            ->create();
    }

}
