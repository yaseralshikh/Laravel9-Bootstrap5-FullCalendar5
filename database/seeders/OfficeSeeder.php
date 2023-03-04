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
                'director'     => 'وردة علي بركات',
            ],
            [
                'name'         => 'مكتب التعليم بأبي عريش',
                'director'     => 'الدكتور حسن بن أبكر خضي',
            ],
            [
                'name'         => 'مكتب التعليم بصامطة',
                'director'     => 'عبدالرزاق بن محمد الصميلي',
            ],
            [
                'name'         => 'مكتب التعليم بالمسارحة والحرث',
                'director'     => 'الدكتور علي بن محمد عطيف',
            ],
            [
                'name'         => 'مكتب التعليم بالعارضة',
                'director'     => 'الدكتور إبراهيم محزري',
            ],
            [
                'name'         => 'مكتب التعليم بفرسان',
                'director'     => 'عبدالله بن محمد نسيب',
            ],
            [
                'name'         => 'إدارة الإشراف',
                'director'     => 'د. أحمد بن ظافر عطيف',
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
