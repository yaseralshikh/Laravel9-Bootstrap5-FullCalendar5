<?php

namespace Database\Seeders;

use App\Models\Week;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weeks = [
            [
                'title'         => 'ف2 - الأسبوع الأول',
                'start'         => '2022-12-04',
                'end'           => '2022-12-08' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع الثاني',
                'start'         => '2022-12-11',
                'end'           => '2022-12-15' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع الثالث',
                'start'         => '2022-12-18',
                'end'           => '2022-12-22' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع الرابع',
                'start'         => '2022-12-25',
                'end'           => '2022-12-29' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع الخامس',
                'start'         => '2023-01-01',
                'end'           => '2023-01-05' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع السادس',
                'start'         => '2023-01-08',
                'end'           => '2023-01-12' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع السابع',
                'start'         => '2023-01-15',
                'end'           => '2023-01-19' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع الثامن',
                'start'         => '2023-01-22',
                'end'           => '2023-01-26' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع التاسع',
                'start'         => '2023-01-29',
                'end'           => '2023-02-02' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع العاشر',
                'start'         => '2023-02-05',
                'end'           => '2023-02-09' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع الحادي عشر',
                'start'         => '2023-02-12',
                'end'           => '2023-02-16' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع الثاني عشر',
                'start'         => '2023-02-19',
                'end'           => '2023-02-23' ,
            ],
            [
                'title'         => 'ف2 - الأسبوع الثالث عشر',
                'start'         => '2023-02-26',
                'end'           => '2023-03-02' ,
            ],
        ];

        foreach ($weeks as $index => $week) {
            Week::create([
                'title'         => $week['title'],
                'start'         => $week['start'] ,
                'end'           => $week['end'] ,
                'semester_id'   => 2,
                'active'        => $index == 9 ? 1 : 0 ,
                'status'        => 1
            ]);
        }
    }
}
