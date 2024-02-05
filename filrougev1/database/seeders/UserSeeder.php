<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'ilias',
            'email' => 'iliasouandouri@gmail.com',
            'password' => Hash::make('iliasilias'),
            'user_groupe_id' => 1,
        ]);

        User::create([
            'name' => 'bob',
            'email' => 'bob@gmail.com',
            'password' => Hash::make('bobbob'),
            'user_groupe_id' => 2,
        ]);

        User::create([
            'name' => 'jo',
            'email' => 'jo@gmail.com',
            'password' => Hash::make('jojo'),
            'user_groupe_id' => 3,
        ]);
    }
}

