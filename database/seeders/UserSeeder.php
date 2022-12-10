<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Yaser Alshikh',
            'email' => 'yaseralshikh@gmail.com',
            'specialization_id' => 14,
            'password' => bcrypt('123123123'),
            'status' => 1,
        ]);
    }
}
