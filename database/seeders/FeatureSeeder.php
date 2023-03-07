<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Office;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeatureSeeder extends Seeder
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
            Feature::create([
                'title' => 'قفل إدخال الخطط',
                'value' => 0,
                'description' => 'المعذرة .. حسب توجيهات إدارة المكتب فقد تم إقفل إدخال الخطط من قبل المشرفين مؤقتاً وسيتم فتحها في وقت لاحق ، شكراُ على اهتمامكم .',
                'section' => 'خطط المشرفين',
                'office_id' => $office->id,
            ]);
        }
    }
}
