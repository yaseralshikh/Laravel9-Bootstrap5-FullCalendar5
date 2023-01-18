<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semesters = [
            [
                'title'         => 'الفصل الدراسي الأول',
                'start'         => '2022-08-28',
                'end'           => '2022-11-24' ,
            ],
            [
                'title'         => 'الفصل الدراسي الثاني',
                'start'         => '2022-12-04',
                'end'           => '2023-03-02' ,
            ],
            [
                'title'         => 'الفصل الدراسي الثالث',
                'start'         => '2023-03-12',
                'end'           => '2023-06-22' ,
            ],
        ];

        foreach ($semesters as $semester) {
            Semester::create([
                'title'         => $semester['title'],
                'start'         => $semester['start'] ,
                'end'           => $semester['end'] ,
                'school_year'   => 1444,
                'status'        => 1
            ]);
        }
    }
}
