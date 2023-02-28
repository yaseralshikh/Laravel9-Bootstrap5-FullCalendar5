<?php

namespace App\Http\Livewire\Backend;

use PDF;
use App\Models\Task;
use App\Models\User;
use App\Models\Week;
use App\Models\Event;
use App\Models\Level;
use App\Models\Office;
use Livewire\Component;
use App\Models\Semester;
use Livewire\WithPagination;
use App\Exports\UsersCountingExport;
use Maatwebsite\Excel\Facades\Excel;

class Dashboard extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $byOffice = null; // filter bt Office
    public $bySemester = null; // filter bt Semester
    public $byLevel = 1; // filter bt Task Level

    public $chartData = [];

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $paginateValue = 10;

    public function semesterActive()
    {
        $semester_active = Semester::whereActive(1)->get();
        return $semester_active[0]->id;
    }

    public function exportExcel()
    {
        return Excel::download(new UsersCountingExport($this->searchTerm,$this->byOffice ? $this->byOffice : auth()->user()->office_id), 'users.xlsx');
    }
    public function exportPDF()
    {
        return response()->streamDownload(function(){

            $users = User::with('events')->where('office_id' , $this->byOffice ? $this->byOffice : auth()->user()->office_id)->orderBy('name', 'asc')->get();
            $pdf = PDF::loadView('livewire.backend.users.users_pdf',['users' => $users]);
            return $pdf->stream('users');
        },'users.pdf');
    }

    public function render()
    {
        $searchString = $this->searchTerm;
        $paginateValue = $this->paginateValue;
        $byLevel = $this->byLevel;
        $byOffice = $this->byOffice ? $this->byOffice : auth()->user()->office_id;
        $bySemester = $this->bySemester  ? $this->bySemester : $this->semesterActive();

        $users = User::whereStatus(1)->where('office_id', $byOffice)
            ->with('events')->whereHas('events', function ($q) use($bySemester) {
                $q->where('semester_id', $bySemester)->whereStatus(true);
                })->search(trim(($searchString)))->orderBy('name', 'asc')->paginate($paginateValue);

        $this->chartData = Event::whereStatus(1)->where('office_id', $byOffice)->with('task:id,name,level_id')->whereHas('task', function ($q) {$q->whereNotIn('name',['إجازة']);})->where('semester_id', $bySemester)->groupBy('task_id')
        ->selectRaw('count(*) as count, task_id')
        ->get()->where('task.level_id', $byLevel)->pluck('count','task.name')->toArray();

        $chartData = json_encode($this->chartData);

        $this->dispatchBrowserEvent('refreshEventChart', ['refresh' => true , 'data' => $chartData]);

        $usersCount = User::where('office_id', $byOffice)->whereStatus(1)->count();
        $eventsCount = Event::whereStatus(1)->where('office_id', $byOffice)->where('semester_id', $bySemester)->count();
        $weeksCount = Week::whereStatus(1)->where('semester_id', $bySemester)->count();
        $eventsSchoolCount = Event::whereStatus(1)->where('office_id', $byOffice)->where('semester_id', $bySemester)->whereHas('task', function ($q) {$q->whereNotIn('name',['إجازة','برنامج تدريبي','يوم مكتبي']);})->count();
        $eventsOfficeCount = Event::whereStatus(1)->where('office_id', $byOffice)->where('semester_id', $bySemester)->whereHas('task', function ($q) {$q->where('name','يوم مكتبي' );})->count();
        $eventsTrainingCount = Event::whereStatus(1)->where('office_id', $byOffice)->where('semester_id', $bySemester)->whereHas('task', function ($q) {$q->where('name','برنامج تدريبي' );})->count();
        $eventsVacationCount = Event::whereStatus(1)->where('office_id', $byOffice)->where('semester_id', $bySemester)->whereHas('task', function ($q) {$q->where('name','إجازة' );})->count();
        $schoolsCount = Task::where('office_id', $byOffice)->whereStatus(1)->whereNotIn('level_id',[4,5])->count();

        $offices = Office::whereStatus(true)->get();
        $semesters =  Semester::whereStatus(true)->get();
        $levels = Level::all();

        return view('livewire.backend.dashboard',[
            'offices'  => $offices,
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
