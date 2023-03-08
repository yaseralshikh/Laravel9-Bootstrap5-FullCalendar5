<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersCountingExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $semester_id;
    protected $office_id;

    function __construct($semester_id,$office_id) {
        $this->semester_id = $semester_id;
        $this->office_id = $office_id;
    }

    public function collection()
    {
        $bySemester = $this->semester_id;

        $users = User::whereStatus(1)->where('office_id', $this->office_id)
            ->with('events')->whereHas('events', function ($q) use($bySemester) {
                $q->where('semester_id', $bySemester)->whereStatus(true);
                })->orderBy('name', 'asc')->get();

        return $users;
    }

    public function map($user) : array {
        return [
            $user->name,
            $user->email,
            $user->specialization->name,
            $user->type,
            $user->events->whereNotIn('task.name',['إجازة','برنامج تدريبي','يوم مكتبي'])->count(),
            $user->events->where('task.name','يوم مكتبي' )->count(),
            $user->events->where('task.name','برنامج تدريبي' )->count(),
            $user->events->where('task.name','إجازة' )->count(),
            $user->events->count(),
        ] ;
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'البريد الالكتروني',
            'ألتخصص',
            'العمل الحالي',
            'زيارات مدارس',
            'ايام مكتبية',
            'برامج تدريبية',
            'اجازات',
            'مجموع الخطط',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:I1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray(
                    array(
                       'font'  => array(
                           'bold'  =>  true,
                       )
                    )
                  );
            },
        ];
    }
}
