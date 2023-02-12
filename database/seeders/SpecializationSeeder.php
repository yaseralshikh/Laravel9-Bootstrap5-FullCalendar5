<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [
            'إدارة مدرسية',
            'تربية إسلامية',
            'لغة عربية',
            'صفوف أولية',
            'رياضيات',
            'علوم',
            'كيمياء',
            'فيزياء',
            'أحياء',
            'لغة إنجليزية',
            'اجتماعيات',
            'فنية',
            'بدنية',
            'حاسب آلي',
            'النشاط الطلابي',
            'التوجيه والإرشاد',
            'الموهوبين',
            'التجهيزات المدرسية',
            'الصحة المدرسية',
            'الجودة',
            'تقنية المعلومات',
            'الاختبارات',
        ];

        foreach ($specializations as $specialization) {
            Specialization::create([
                'name' => $specialization
            ]);
        }
    }
}
