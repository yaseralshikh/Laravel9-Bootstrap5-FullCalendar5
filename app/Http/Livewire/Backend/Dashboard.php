<?php

namespace App\Http\Livewire\Backend;

use App\Models\Event;
use App\Models\School;
use App\Models\Semester;
use App\Models\User;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\RadarChartModel;
use Asantibanez\LivewireCharts\Models\TreeMapChartModel;

class Dashboard extends Component
{
    public $eventsCount;
    public $usersPlanCount;

    // for chart
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
        $this->getUsersCount();
    }

    public function getEventsCount($option = Null)
    {
        $this->eventsCount = Event::query()
            ->whereBetween('start', $this->getDateRange($option))->count();
    }

    public function getDateRange($option)
    {
        if ($option == Null) {
            $event = Event::with('week.semester')->latest()->take(1)->get();
            $semester =
            $start = $event[0]->week->semester->start;
            $end = $event[0]->week->semester->end;
            return [$start, $end];
        } else {
            $semester = Semester::where('status', 1)->where('id', $option)->get();
            $semesterStart = $semester[0]->start;
            $semesterEnd = $semester[0]->end;
            return [$semesterStart, $semesterEnd];
        }
    }

    public function getUsersCount($option = 1)
    {
        $this->usersPlanCount = Event::query()
            ->where('user_id', $option)
            ->where(function ($query) {
                $query->whereHas('week', function ($q) {
                    $q->where('semester_id', $this->semesterActive());
                });
            })->count();
    }

    public function semesterActive()
    {
        $semester_active = Semester::where('active' ,1)->get();
        return $semester_active[0]->id;
    }

    public function render()
    {
        // for chart
        $events = Event::where('status', true)
        ->where(function ($query) {
            $query->whereHas('week', function ($q) {
                $q->where('semester_id', $this->semesterActive());
            });
        })->get();

        foreach ($events as $event) {
            $items[] = $event->title;
        }

        $this->types =$items;

        foreach ($items as $value) {
            $this->colors += [
                $value => $this->randomHex(),
            ];
        }

        $events = Event::whereIn('title', $this->types)->get();
        $columnChartModel = $events->groupBy('title')
        ->reduce(function ($columnChartModel, $data) {
            $type = $data->first()->title;
            $value = $data->count('title');

            return $columnChartModel->addColumn($type, $value, $this->colors[$type]);
        }, LivewireCharts::columnChartModel()
            ->setTitle('Events by Type')
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

        // chart
        $usersCount = User::where('status', 1)->count();
        $semesters = Semester::where('status', 1)->orderBy('id')->latest()->take(3)->get();
        $users = User::where('status', 1)->orderBy('id')->get();
        $schools = School::where('status', 1)->whereNotIn('level_id',[4,5])->orderBy('name')->get();
        $schoolsCount = School::where('status', 1)->whereNotIn('level_id',[4,5])->count();
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
