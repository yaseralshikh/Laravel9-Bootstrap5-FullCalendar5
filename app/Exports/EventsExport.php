<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Event;
use Alkoumi\LaravelHijriDate\Hijri;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class EventsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $search;
    protected $selected_rows;
    protected $byWeek;
    protected $byStatus;
    protected $byOffice;

    function __construct($search,$selectedRows,$byWeek,$byStatus,$byOffice) {
        $this->search = $search;
        $this->selected_rows = $selectedRows;
        $this->byWeek = $byWeek;
        $this->byStatus = $byStatus;
        $this->byOffice = $byOffice;
    }

    public function collection()
    {
        $week =$this->byWeek;
        $office =$this->byOffice ? $this->byOffice : auth()->user()->office_id;

        if ($this->selected_rows) {
            return Event::whereIn('id', $this->selected_rows)
                ->where('status', $this->byStatus)->where('office_id', $office)->when($week, function($query) use ($week){
                    $query->where('week_id', $week);
                })
                ->search(trim(($this->search)))
                //->latest('created_at')
                ->orderBy('created_at', 'asc')->get();
        } else {
            return Event::query()
            ->where('status', $this->byStatus)->where('office_id', $office)->when($this->byWeek, function($query) use ($week){
                $query->where('week_id', $week);
            })
            ->search(trim(($this->search)))
            //->latest('created_at')
            ->orderBy('created_at', 'asc')->get();
        }
    }

    public function map($event) : array {
        return [
            $event->id,
            $event->user->name,
            $event->title,
            Hijri::Date('Y-m-d', $event->start) .' / '. Hijri::Date('l', $event->start) .' / '. Carbon::parse($event->start)->toDateString(),
            $event->semester->title,
            $event->week->title,
            $event->office->name,
            $event->status ? 'Active' : 'Inactive',
        ] ;
    }

    public function headings(): array
    {
        return [
            'id',
            'Name',
            'Event',
            'Date',
            'Semester',
            'Week',
            'Office',
            'Status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:H1'; // All headers
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
