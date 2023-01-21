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
            [
                'name'         => 'مكتب التعليم بوسط جازان بنين',
                'director'     => 'عبدالرحمن بن عسيري عكور',
            ],
            [
                'name'         => 'مكتب التعليم بوسط جازان بنات',
                'director'     => 'not yet',
            ],
            [
                'name'         => 'مكتب التعليم بأبي عريش',
                'director'     => 'not yet',
            ],
            [
                'name'         => 'مكتب التعليم بصامطة',
                'director'     => 'not yet',
            ],
            [
                'name'         => 'مكتب التعليم بالمسارحة والحرث',
                'director'     => 'not yet',
            ],
            [
                'name'         => 'مكتب التعليم بالعارضة',
                'director'     => 'not yet',
            ],
            [
                'name'         => 'مكتب التعليم بفرسان',
                'director'     => 'not yet',
            ],
            [
                'name'         => 'الإدارة العامة للتعليم بمنطقة جازان',
                'director'         => 'not yet',
            ],
        ];

        foreach ($offices as $office) {
            Office::create([
                'name' => $office['name'],
                'director' => $office['director'],
            ]);
        };
    }
}
