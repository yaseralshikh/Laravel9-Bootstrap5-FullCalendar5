<?php

namespace App\Http\Livewire\Backend;

use App\Models\Task;
use App\Models\User;
use App\Models\Week;
use App\Models\Event;
use App\Models\Level;
use Livewire\Component;
use App\Models\Semester;

class Dashboard extends Component
{
    public $bySemester = null; // filter bt Semester
    public $byLevel = 1; // filter bt Task Level

    public $chartData = [];

    public function semesterActive()
    {
        $semester_active = Semester::whereActive(1)->get();
        return $semester_active[0]->id;
    }

    public function render()
    {
        $byLevel = $this->byLevel;
        $bySemester = $this->bySemester ? $this->bySemester : $this->semesterActive();

        $semesters =  Semester::whereStatus(1)->get();
        $levels = Level::all();

        $this->chartData = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->with('task:id,name,level_id')->whereHas('task', function ($q) {$q->whereNotIn('name',['إجازة']);})->where('semester_id', $bySemester)->groupBy('task_id')
        ->selectRaw('count(*) as count, task_id')
        ->get()->where('task.level_id', $byLevel)->pluck('count','task.name')->toArray();

        $chartData = json_encode($this->chartData);

        $this->dispatchBrowserEvent('refreshEventChart', ['refresh' => true , 'data' => $chartData]);

        $users = User::query()
        ->where('office_id', auth()->user()->office_id)
        ->with(['events' => function ($query) use($bySemester) {
            $query->where('semester_id', $bySemester)->whereStatus(true);
        }])->orderBy('name', 'asc')->get();

        $usersCount = User::where('office_id', auth()->user()->office_id)->whereStatus(1)->count();
        $eventsCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id', $bySemester)->count();
        $weeksCount = Week::whereStatus(1)->where('semester_id', $bySemester)->count();
        $eventsSchoolCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id', $bySemester)->whereHas('task', function ($q) {$q->whereNotIn('name',['إجازة','برنامج تدريبي','يوم مكتبي']);})->count();
        $eventsOfficeCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id', $bySemester)->whereHas('task', function ($q) {$q->where('name','يوم مكتبي' );})->count();
        $eventsTrainingCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id', $bySemester)->whereHas('task', function ($q) {$q->where('name','برنامج تدريبي' );})->count();
        $eventsVacationCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id', $bySemester)->whereHas('task', function ($q) {$q->where('name','إجازة' );})->count();
        $schoolsCount = Task::where('office_id', auth()->user()->office_id)->whereStatus(1)->whereNotIn('level_id',[4,5])->count();

        return view('livewire.backend.dashboard',[
            'semesters'  => $semesters,
            'levels'  => $levels,
            'chartData'  => $chartData,
            'usersCount' => $usersCount,
            'schoolsCount' => $schoolsCount,
            'users' => $users,
            'weeksCount' => $weeksCount,
            'eventsSchoolCount' => $eventsSchoolCount,
            'eventsOfficeCount' => $eventsOfficeCount,
            'eventsTrainingCount' => $eventsTrainingCount,
            'eventsVacationCount' => $eventsVacationCount,
            'eventsCount' => $eventsCount,
        ])->layout('layouts.admin');
    }
}
