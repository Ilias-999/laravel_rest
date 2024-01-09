<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserGroup;

class UserGroupSeeder extends Seeder
{

    public function run()
    {

        UserGroup::truncate();


        UserGroup::create(['name' => 'admin']);
        UserGroup::create(['name' => 'buyer']);
        UserGroup::create(['name' => 'seller']);
    }
}
