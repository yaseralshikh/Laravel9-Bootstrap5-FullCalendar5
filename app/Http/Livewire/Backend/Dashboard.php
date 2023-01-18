<?php

namespace App\Http\Livewire\Backend;

use App\Models\Event;
use App\Models\School;
use App\Models\Semester;
use App\Models\User;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
//use Asantibanez\LivewireCharts\Models\RadarChartModel;
//use Asantibanez\LivewireCharts\Models\TreeMapChartModel;

class Dashboard extends Component
{
    public $eventsCount;

    // for chart
    public $items = [];
    public $types;

    public $colors = [];

    public $firstRun = true;

    public $showDataLabels = true;

    function randomHex() {
        $chars = 'ABCDEF0123456789';
        $color = '#';
        for ( $i = 0; $i < 6; $i++ ) {
           $color .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $color;
    }

    // end chart

    public function mount()
    {
        $this->getEventsCount();
    }

    public function getEventsCount($option = Null)
    {
        if ($this->getDateRange($option)) {
            $this->eventsCount = Event::query()
                ->where('office_id', auth()->user()->office_id)
                ->whereBetween('start', $this->getDateRange($option))
                ->count();
        }
    }

    public function getDateRange($option)
    {
        if ($option == Null) {
            $semester = Semester::where('status', 1)->where('id', $this->semesterActive())->get();
            if ($semester) {
                $start = $semester[0]->start;
                $end = $semester[0]->end;

                return [$start, $end];

            } else {

                return Null;

            }

        } else {

            $semester = Semester::where('status', 1)->where('id', $option)->get();

            $start = $semester[0]->start;
            $end = $semester[0]->end;

            return [$start, $end];
        }
    }

    public function semesterActive()
    {
        $semester_active = Semester::where('active' ,1)->get();
        return $semester_active[0]->id;
    }

    public function getUsersProperty()
    {
        return User::query()
        ->where('office_id', auth()->user()->office_id)
        ->with(['events' => function ($query) {
            $query->where('semester_id', $this->semesterActive())->where('status', true);
        }])->orderBy('name', 'asc')->get();
    }

    public function render()
    {
        // for chart
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

            $events = Event::whereIn('title', $this->types)->where('status', 1)->where('semester_id', $this->semesterActive())->where('office_id', auth()->user()->office_id)->get();
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
        $usersCount = User::where('office_id', auth()->user()->office_id)->where('status', 1)->count();
        $semesters = Semester::where('status', 1)->orderBy('id')->latest()->take(3)->get();
        $users = $users = $this->users;
        $schools = School::where('office_id', auth()->user()->office_id)->where('status', 1)->whereNotIn('level_id',[4,5])->orderBy('name')->get();
        $schoolsCount = School::where('office_id', auth()->user()->office_id)->where('status', 1)->whereNotIn('level_id',[4,5])->count();
        return view('livewire.backend.dashboard',[
            'usersCount' => $usersCount,
            'schoolsCount' => $schoolsCount,
            'users' => $users,
            'semesters' => $semesters,
            'schools' => $schools,
            'columnChartModel' => $columnChartModel,
        ])->layout('layouts.admin');
    }
}
