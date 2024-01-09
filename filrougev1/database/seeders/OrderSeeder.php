<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OrderSeeder extends Seeder
{



    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Order::truncate();

        Order::factory()
            ->count(20)
            ->create();
    }
}
