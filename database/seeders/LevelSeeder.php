<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = ['ابتدائي' ,'متوسط' ,'ثانوي' , 'مجمع' , 'أخرى', 'التعليم المستمر', 'رياض الأطفال'];

        foreach ($levels as $level) {
            Level::create([
                'name' => $level
            ]);
        }
    }
}
