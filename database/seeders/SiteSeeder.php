<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\Site;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offices = Office::all();
        foreach ($offices as $office) {
            Site::create([
                'title' => 'قفل إدخال الخطط',
                'description' => 'المعذرة .. حسب توجيهات إدارة المكتب فقد تم إقفل إدخال الخطط من قبل المشرفين مؤقتاً وسيتم فتحها في وقت لاحق ، شكراُ على اهتمامكم .',
                'section' => 'front_end',
                'office_id' => $office->id,
            ]);
        }
    }
}
