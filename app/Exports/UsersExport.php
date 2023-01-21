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
    protected $office_id;

    function __construct($search,$selectedRows,$office_id) {
        $this->search = $search;
        $this->selected_rows = $selectedRows;
        $this->office_id = $office_id;
    }

    public function collection()
    {
        if ($this->selected_rows) {
            return User::whereIn('id', $this->selected_rows)->orderBy('name', 'asc')
            ->get();
        } else {
            return User::query()
            ->where('name', 'like', '%'.$this->search.'%')
            ->where('office_id', $this->office_id)
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
            $user->type,
            $user->roles[0]->name,
            $user->status ? 'مفعل' : 'غير مفعل',
        ] ;
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'email',
            'specialization',
            'type',
            'role',
            'status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:G1'; // All headers
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
