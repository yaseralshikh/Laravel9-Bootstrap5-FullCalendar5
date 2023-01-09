<?php

namespace App\Http\Livewire\Backend;

use App\Models\Event;
use App\Models\Semester;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public $eventsCount;

    public function mount()
    {
        $this->getEventsCount();
    }

    public function getEventsCount($option = 1)
    {
        $this->eventsCount = Event::query()
            ->whereBetween('start', $this->getDateRange($option))->count();
    }

    public function getDateRange($option)
    {
        $semester = Semester::where('status', 1)->where('id', $option)->get();
        $semesterStart = $semester[0]->start;
        $semesterEnd = $semester[0]->end;
        return [$semesterStart, $semesterEnd];
    }

    public function render()
    {
        $usersCount = User::where('status', 1)->count();
        $semesters = Semester::orderBy('id')->latest()->take(3)->get();;
        //$eventsCount = Event::where('status', 1)->count();
        return view('livewire.backend.dashboard',[
            'usersCount' => $usersCount,
            //'eventsCount' => $eventsCount,
            'semesters' => $semesters,
        ])->layout('layouts.admin');
    }
}
