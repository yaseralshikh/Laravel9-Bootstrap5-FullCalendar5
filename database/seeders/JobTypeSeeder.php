<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            'مشرف تربوي',
            'تقنية المعلومات',
            'مساعد مدير المكتب للشؤون التعليمية',
            'مساعد مدير المكتب للشؤون المدرسية',
            'مدير مكتب التعليم',
            'مدير مكتب الإشراف',
            'المساعد للشؤون التعليمة',
            'المساعد للشؤون المدرسية',
            'مدير ادارة',
            'إداري',
            'المدير العام للتعليم',
        ];

        foreach ($jobs as $job) {
            JobType::create([
                'title' => $job
            ]);
        }
    }
}
