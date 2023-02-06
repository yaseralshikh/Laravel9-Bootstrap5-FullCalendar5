<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::create([
            'name' => 'ياسر محمد أحمد الشيخ',
            'email' => 'yaseralshikh@gmail.com',
            'specialization_id' => 14,
            'office_id' => 1,
            'type' => 'مشرف تربوي',
            'edu_type' => 'الشؤون التعليمية',
            'password' => bcrypt('123123123'),
            'status' => 1,
        ]);

        $user->attachRole('superadmin');
    }
}
