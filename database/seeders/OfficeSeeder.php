<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = [
            'مكتب التعليم بوسط جازان بنين',
            'مكتب التعليم بوسط جازان بنات',
            'مكتب التعليم بأبي عريش',
            'مكتب التعليم بصامطة',
            'مكتب التعليم بالمسارحة والحرث',
            'مكتب التعليم بالعارضة',
            'مكتب التعليم بفرسان',
            'الإدارة العامة للتعليم بمنطقة جازان',
        ];

        foreach ($offices as $office) {
            Office::create([
                'name' => $office,
            ]);
        };
    }
}
