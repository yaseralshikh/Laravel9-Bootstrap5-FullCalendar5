<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Event;
use App\Models\Semester;
use App\Models\Task;
use App\Models\User;
use App\Models\Week;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class Dashboard extends Component
{
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
        $events = Event::where('status', 1)->whereNotIn('title', ['إجازة'])->where('semester_id', $this->semesterActive())->where('office_id', auth()->user()->office_id)->get();

        if ($events) {
            foreach ($events as $event) {
                $this->items[] = $event->title;
            }

            $this->types =$this->items;

            foreach ($this->items as $value) {
                $this->colors += [
                    $value => $this->randomHex(),
                ];
            }

            $events = Event::whereIn('title', $this->types)->whereStatus(1)->where('semester_id', $this->semesterActive())->where('office_id', auth()->user()->office_id)->get();
            $columnChartModel = $events->groupBy('title')
            ->reduce(function ($columnChartModel, $data) {
                $type = $data->first()->title;
                $value = $data->count('title');

                return $columnChartModel->addColumn($type, $value, $this->colors[$type]);
            }, LivewireCharts::columnChartModel()
                ->setTitle('احصائية خطط الزيارات خلال الفصل الدراسي')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility(false)
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setOpacity(0.60)
                //->setColors(['#b01a1b', '#d41b2c', '#ec3c3b', '#f66665'])
                ->setColumnWidth(70)
                ->withGrid()
            );

            $this->firstRun = false;
        }
        // chart

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
            'columnChartModel' => $columnChartModel,
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
