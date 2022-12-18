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
        $semester = ['الفصل الدراسي الأول' ,'الفصل الدراسي الثاني' ,'الفصل الدراسي الثالث'];
        for ($i=0; $i < 3; $i++) {
            Semester::create([
                'name' => $semester[$i]
            ]);
        }
    }
}
