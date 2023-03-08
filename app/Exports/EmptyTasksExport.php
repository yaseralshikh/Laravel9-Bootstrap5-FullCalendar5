<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmptyTasksExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $semester_id;
    protected $office_id;

    function __construct($semester_id, $office_id) {
        $this->semester_id = $semester_id;
        $this->office_id = $office_id;
    }

    public function collection()
    {
        $bySemester = $this->semester_id;

        $tasks = Task::whereStatus(true)->where('office_id', $this->office_id)->whereIn('level_id', [1,2,3])
        ->withCount([
            'events' => function ($query) use($bySemester) {
                $query->where('semester_id', $bySemester);
            }
        ])
        ->having('events_count', '=', 0)
        ->orderBy('name', 'asc')
        ->orderBy('level_id', 'asc')
        ->get();

        return $tasks ;
    }

    public function map($task) : array {
        return [
            $task->name,
            $task->level->name,
            $task->events_count ? '' : '0',
        ] ;
    }

    public function headings(): array
    {
        return [
            'اسم المدرسة',
            'المرحلة',
            'عدد الزيارات',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:C1'; // All headers
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
