<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $search;
    protected $selected_rows;

    function __construct($search,$selectedRows) {
        $this->search = $search;
        $this->selected_rows = $selectedRows;
    }

    public function collection()
    {
        if ($this->selected_rows) {
            return User::whereIn('id', $this->selected_rows)->orderBy('name', 'asc')
            ->get();
        } else {
            return User::query()
            ->where('name', 'like', '%'.$this->search.'%')
            ->orderBy('name', 'asc')
            ->get();
        }
    }

    public function map($user) : array {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->specialization->name,
            $user->roles[0]->name,
            $user->status,
        ] ;
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'specialization',
            'role',
            'status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
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
