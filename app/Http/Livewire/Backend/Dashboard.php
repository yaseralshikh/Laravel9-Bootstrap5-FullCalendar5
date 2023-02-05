<?php

namespace App\Http\Livewire\Backend;

use App\Models\Task;
use App\Models\User;
use App\Models\Week;
use App\Models\Event;
use Livewire\Component;
use App\Models\Semester;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class Dashboard extends Component
{
    //public $chartEventsTitle = [];
    public $chartData = [];

    // for chart
    public $items = [];
    public $types;

    public $colors = [];

    public $firstRun = true;

    public $showDataLabels = true;

    public function randomHex() {
        $chars = 'ABCDEF0123456789';
        $color = '#';
        for ( $i = 0; $i < 6; $i++ ) {
            $color .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $color;
    }
    // end chart

    public function semesterActive()
    {
        $semester_active = Semester::where('active' ,1)->get();
        return $semester_active[0]->id;
    }

    public function render()
    {
        // chart
        //$events = Event::where('status', 1)->whereNotIn('title', ['إجازة'])->where('semester_id', $this->semesterActive())->where('office_id', auth()->user()->office_id)->pluck('title');

        // if ($events) {

        //     foreach ($events as $value) {
        //         $this->colors += [
        //             $value => $this->randomHex(),
        //         ];
        //     }

        //     $events = Event::whereIn('title', $events)->whereStatus(1)->where('semester_id', $this->semesterActive())->where('office_id', auth()->user()->office_id)->get();
        //     $columnChartModel = $events->groupBy('title')
        //     ->reduce(function ($columnChartModel, $data) {
        //         $type = $data->first()->title;
        //         $value = $data->count('title');

        //         return $columnChartModel->addColumn($type, $value, $this->colors[$type]);
        //     }, LivewireCharts::columnChartModel()
        //         ->setTitle('احصائية خطط الزيارات خلال الفصل الدراسي')
        //         ->setAnimated($this->firstRun)
        //         ->withOnColumnClickEventName('onColumnClick')
        //         ->setLegendVisibility(false)
        //         ->setDataLabelsEnabled($this->showDataLabels)
        //         ->setOpacity(0.60)
        //         //->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
        //         ->setColumnWidth(70)
        //         ->withGrid()
        //     );

        //     $this->firstRun = false;
        // }
        // End of chart

        // New Chart
        //$chartEventsTitle = Event::whereStatus(1)->whereNotIn('title', ['إجازة'])->where('semester_id', $this->semesterActive())->where('office_id', auth()->user()->office_id)->select('title')->pluck('title');
        $this->chartData = Event::whereStatus(1)->groupBy('title')
            ->selectRaw('count(*) as count, title')
            ->pluck('count','title')->toArray();

        $chartData = json_encode($this->chartData);


        // foreach($chartEventCount as $title => $count){
        //     $this->title_event[] = $title;
        //     $this->count_event[] = $count;
        // }


        // $title_event = $this->title_event;
        // $count_event = $this->count_event;

        //dd($title_event,$count_event);


        // End of Chart

        $users = User::query()
        ->where('office_id', auth()->user()->office_id)
        ->with(['events' => function ($query) {
            $query->where('semester_id', $this->semesterActive())->whereStatus(true);
        }])->orderBy('name', 'asc')->get();

        $usersCount = User::where('office_id', auth()->user()->office_id)->whereStatus(1)->count();
        $eventsCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id',$this->semesterActive())->count();
        $weeksCount = Week::whereStatus(1)->where('semester_id',$this->semesterActive())->count();
        $eventsSchoolCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id',$this->semesterActive())->whereNotIn('title',['يوم مكتبي','برنامج تدريبي','إجازة'])->count();
        $eventsOfficeCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id',$this->semesterActive())->where('title','يوم مكتبي')->count();
        $eventsTrainingCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id',$this->semesterActive())->where('title','برنامج تدريبي')->count();
        $eventsVacationCount = Event::whereStatus(1)->where('office_id', auth()->user()->office_id)->where('semester_id',$this->semesterActive())->where('title','إجازة')->count();
        $schoolsCount = Task::where('office_id', auth()->user()->office_id)->whereStatus(1)->whereNotIn('level_id',[4,5])->count();

        return view('livewire.backend.dashboard',[
            //'columnChartModel' => $columnChartModel,
            //'chartEventsTitle' => $chartEventsTitle,
            'chartData'  => $chartData,
            // 'title_event'  => $title_event,
            // 'count_event'  => $count_event,
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
