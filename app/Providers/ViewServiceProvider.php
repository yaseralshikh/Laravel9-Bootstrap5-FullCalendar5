<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Semester;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class ViewServiceProvider extends ServiceProvider
{
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

    public function semesterActive()
    {
        $semester_active = Semester::where('active' ,1)->get();
        return $semester_active[0]->id;
    }
    // end chart

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (request()->is('admin')) {

            // for chart

            view()->composer('*', function ($view) {

                if (!Cache::has('columnChartModel')) {
                    # code...
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

                        Cache::remember('columnChartModel', 3600, function () use ($columnChartModel) {
                            return $columnChartModel;
                        });
                    }
                }

                $columnChartModel = Cache::get('columnChartModel');

                $view->with([
                    'columnChartModel' => $columnChartModel,
                ]);
            });
            // chart
        }
    }
}
