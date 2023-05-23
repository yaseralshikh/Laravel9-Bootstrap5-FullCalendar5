<?php

namespace App\Http\Livewire\Backend\Events;

use App\Exports\EventsExport;
use App\Models\Event;
use App\Models\Level;
use App\Models\Feature;
use App\Models\Office;
use App\Models\Semester;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\User;
use App\Models\Week;
use App\Rules\SemesterRule;
use App\Rules\WeekRule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ListEvents extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';
    public $paginateValue = 50;

    public $data = [];

    public $tasks = [];
    public $level_id;

    public $items = [];

    public $event;

    public $byWeek = null; //filter by week_id
    public $byEduType = null; // filter bt edu_type
    public $byStatus = 0; // filter bt status

    // public $users = []; // for office -> users connected
    // public $weeks = []; // for semester -> weeks connected
    // public $tasks = []; // for office -> tasks connected

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $eventIdBeingRemoved = null;

    public $selectedRows = [];
    public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteEvents'];

    public $excelFile = null;
    public $importTypevalue = 'addNew';

    public $featureValue = null;

    // update Site Status

    public function updateFeatureValue()
    {
        $this->featureValue === 0 ? 1 : 0;

        $feature = Feature::where('office_id', auth()->user()->office_id)->where('title', 'قفل إدخال الخطط')->first();
        $feature->update(['value' => $this->featureValue]);

        $this->alert('success', __('site.featureValueUpdateSuccessfully'), [
            'position' => 'top-end',
            'timer' => 2000,
            'toast' => true,
            'text' => null,
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);
    }

    // Updated Select Page Rows

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->events->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    // Reset Selected Rows

    public function resetSelectedRows()
    {
        $this->reset(['selectedRows', 'selectPageRows']);
    }

    // show Sweetalert Confirmation for Delete

    public function deleteSelectedRows()
    {
        $this->dispatchBrowserEvent('show-delete-alert-confirmation');
    }

    // set All selected Event As Active

    public function setAllAsActive()
    {
        Event::whereIn('id', $this->selectedRows)->update(['status' => 1]);

        $this->alert('success', __('site.eventActiveSuccessfully'), [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);

        $this->reset(['selectPageRows', 'selectedRows']);
    }

    // set All selected Event As InActive

    public function setAllAsInActive()
    {
        Event::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', __('site.eventInActiveSuccessfully'), [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);

        $this->reset(['selectPageRows', 'selectedRows']);
    }

    // Delete Selected Event

    public function deleteEvents()
    {
        // delete selected events from database
        Event::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', __('site.deleteSuccessfully'), [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'text' => null,
            'showCancelButton' => false,
            'showConfirmButton' => false,
        ]);

        $this->reset(['selectPageRows', 'selectedRows']);
    }

    // Sort By Column Name

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;

    }

    // Swap Sort Direction

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    // Swap filter by Event status

    public function swapByStatus()
    {
        return $this->byStatus === 0 ? '1' : '0';
    }

    // Updated Search Term
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    // show add new Event form modal

    public function addNewEvent()
    {
        $this->reset(['data','tasks','level_id']);
        //$this->resetExcept(['byStatus','byWeek','searchTerm']);
        $this->showEditModal = false;
        $this->data['status'] = 1;
        // $this->data['semester_id'] = $this->semesterActive();
        // $this->data['week_id'] = $this->weekActive();

        $this->dispatchBrowserEvent('show-form');
    }

    // Create new Event

    public function createEvent()
    {
        // try {
        $validatedData = Validator::make($this->data, [
            'user_id'   => 'required',
            'task_id'   => 'required',
            // 'week_id' => ['required_with:start', new WeekRule($this->data['start'])],
            'start'     => 'required',
            'status'    => 'required',
        ])->validate();

        switch ($validatedData['task_id']) {
            case 1:
                $color = '#000000';
                break;
            case 2:
                $color = '#cf87fa';
                break;
            case 3:
                $color = '#eb6c0c';
                break;
            default:
                $color = '#298A08';
        }

        $validatedData['end'] = date('Y-m-d', strtotime($validatedData['start'] . ' + 1 days'));
        $validatedData['color'] = $color;

        $semester_Id = Semester::where('start', '<=', $validatedData['start'])->where('end', '>=', $validatedData['end'])->pluck('id')->first();
        $week_Id = Week::where('start', '<=', $validatedData['start'])->where('end', '>=', $validatedData['end'])->pluck('id')->first();

        if ($semester_Id && $week_Id) {

            if (empty($validatedData['office_id'])) {
                $validatedData['office_id'] = auth()->user()->office_id;
            }

            $validatedData['semester_id'] = $semester_Id;
            $validatedData['week_id'] = $week_Id;

            Event::create($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', __('site.saveSuccessfully'), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

        } else {

            $this->alert('error', 'اليوم المحدد غير مطابق للفصل الدراسي', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

        }

        // } catch (\Throwable$th) {
        //     $message = $this->alert('error', $th->getMessage() , [
        //         'position' => 'center',
        //         'timer' => 3000,
        //         'toast' => true,
        //         'text' => null,
        //         'showCancelButton' => false,
        //         'showConfirmButton' => false,
        //     ]);
        //     return $message;
        // }
    }

    // show Update new event form modal

    public function edit(Event $event)
    {
        $this->reset(['data','tasks','level_id']);

        $this->showEditModal = true;

        $this->level_id = $event->task->level_id;

        $this->LevelOption();

        $this->event = $event;

        $this->data = $event->toArray();

        $this->data['start'] = Carbon::parse($this->data['start'])->toDateString();

        $this->dispatchBrowserEvent('show-form');
    }

    // Update Event

    public function updateEvent()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'task_id'       => 'required',
                'user_id'       => 'required',
                'semester_id'   => ['required', new SemesterRule($this->data['start'])],
                'week_id'       => ['required', new WeekRule($this->data['start'])],
                'office_id'     => 'nullable',
                'start'         => 'required',
                'status'        => 'required',
            ])->validate();

            switch ($validatedData['task_id']) {
                case 1:
                    $color = '#000000';
                    break;
                case 2:
                    $color = '#cf87fa';
                    break;
                case 3:
                    $color = '#eb6c0c';
                    break;
                default:
                    $color = '#298A08';
            }

            $validatedData['color'] = $color;

            $validatedData['end'] = date('Y-m-d', strtotime($validatedData['start'] . ' + 1 days'));

            $this->event->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', __('site.updateSuccessfully'), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

        } catch (\Throwable$th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
            return $message;
        }
    }

    // Show Modal Form to Confirm Event Removal

    public function confirmEventRemoval($eventId)
    {
        $this->eventIdBeingRemoved = $eventId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete Event

    public function deleteEvent()
    {
        try {
            $event = Event::findOrFail($this->eventIdBeingRemoved);

            $event->delete();

            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->alert('success', __('site.deleteSuccessfully'), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

        } catch (\Throwable$th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
            return $message;
        }
    }

    // Show Import Excel Form

    public function importExcelForm()
    {
        $this->reset(['excelFile', 'importTypevalue']);
        $this->dispatchBrowserEvent('show-import-excel-modal');
    }

    // Export Excel File
    public function exportExcel()
    {
        $byStatus = $this->byStatus;
        $byWeek = $this->byWeek;
        $byEduType = $this->byEduType;
        $byOffice = auth()->user()->office_id;

        if ($byStatus) {
            if ($byWeek && $byEduType) {
                return Excel::download(new EventsExport(
                    $this->searchTerm,
                    $this->selectedRows,
                    $this->byWeek,
                    $byEduType,
                    $this->byStatus,
                    $byOffice),
                    'events.xlsx');
            } else {
                $this->alert('error', __('site.selectWeek') . ' وكذلك ' . __('site.selectEduType'), [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => true,
                    'text' => null,
                    'showCancelButton' => false,
                    'showConfirmButton' => false,
                ]);
            }
        } else {
            $this->alert('error', __('site.selectStatus'), [
                'position' => 'center',
                'timer' => 2000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
        }
    }

    public function importType($value)
    {
        $this->importTypevalue = $value;
    }

    public function importExcel()
    {
        //
    }

    public function userNullPlan()
    {
        $byWeek = $this->byWeek;
        $byEduType = $this->byEduType;
        $byOffice = auth()->user()->office_id;

        $this->items = [];

        if ($byWeek && $byEduType) {

            $week_range = Week::whereId($byWeek)->get()->first();

            $start = Carbon::parse($week_range->start);
            $end = Carbon::parse($week_range->end);

            $dates = [];

            while ($start->lte($end)) {
                $dates[] = $start->toDateString();
                $start->addDay();
            }

            $days_range = count($dates)-1;

            $users = User::where('status', true)->where('edu_type', $byEduType)->where('office_id', $byOffice ? $byOffice : auth()->user()->office_id)->with(['events' => function ($query) use ($byWeek) {
                $query->where('week_id', $byWeek)->orderBy('start', 'asc');
            }])->get();

            $table = '<table style="border-collapse: collapse;">';
            $table .= '<thead><tr><th style="border: 1px solid;text-align: center;background-color: #f2f2f2;">! مشرفين خططهم غير مكتملة</th><th style="border: 1px solid;text-align: center;background-color: #f2f2f2;">م</th></tr></thead>';
            $table .= '<tbody>';

            $index = 0;

            foreach ($users as $user) {
                if ($user->events->count() < $days_range ) {
                    $index = $index+ 1;
                    $table .= '<tr>';
                    $table .= '<td style="border: 1px solid;text-align: center;">' . $user->name . ' (<span style="color:red"> ' . $user->events->count() . ' </span>)' . '</td>';
                    $table .= '<td style="border: 1px solid;text-align: center;">' . $index . '</td>';
                    $table .= '</td>';
                }
            }

            $table .= '</tbody></table>';

            if (count($users)) {
                $this->alert('error', $table, [
                    'position' => 'center',
                    'timer' => null,
                    'toast' => true,
                    'text'  => null,
                    'showCancelButton' => false,
                    'showConfirmButton' => true,
                    //'width' => '550px',
                ]);

            } else {
                $this->alert('success', __('site.noReviews'), [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                    'text' => null,
                    'showCancelButton' => false,
                    'showConfirmButton' => false,
                    //'width' => '500px',
                ]);
            }

        } else {
            $this->alert('error', __('site.selectWeek') . ' وكذلك ' . __('site.selectEduType'), [
                'position' => 'center',
                'timer' => 6000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'width' => '500px',
            ]);
        }
    }

    public function taskNullPlan()
    {
        $byWeek = $this->byWeek;
        $byOffice = auth()->user()->office_id;

        if ($byWeek) {

            $events = Event::where('office_id', $byOffice ? $byOffice : auth()->user()->office_id)->where('week_id', $byWeek)->pluck('task_id')->toArray();

            $tasks_null_plan = Task::where('office_id', $byOffice ? $byOffice : auth()->user()->office_id)->whereNotIn('id' , array_values($events))->whereNotIn('level_id',[5])->get();

            $chunks = $tasks_null_plan->chunk(3);

            $tableRows = '';

            foreach ($chunks as $chunk) {
                $tableRow = '<tr>';
                foreach ($chunk as $task) {
                    $tableRow .= '<td style="border: 1px solid;text-align: center;">' . $task->name . '</td>';
                }
                $tableRow .= str_repeat('<td style="border: 1px solid;text-align: center;"></td>', 3 - count($chunk));
                $tableRow .= '</tr>';
                $tableRows .= $tableRow;
            }

            $table = '<table style="border-collapse: collapse;"><thead><tr><th colspan="3" style="border: 1px solid;text-align: center;background-color: #f2f2f2;">! مدارس لم تدرج في خطة هذا الاسبوع</th></tr></thead><tbody>' . $tableRows . '</tbody></table>';

            $this->alert('warning', $table, [
                'position' => 'center',
                'timer' => null,
                'toast' => true,
                'text'  => null,
                'showCancelButton' => false,
                'showConfirmButton' => true,
                'width' => '700px',
            ]);

        } else {
            $this->alert('error', __('site.selectWeek'), [
                'position' => 'center',
                'timer' => 6000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
                'width' => '500px',
            ]);
        }
    }

    public function exportPDF()
    {
        $selectedRows = $this->selectedRows;
        $byWeek = $this->byWeek;
        $byEduType = $this->byEduType;
        $byOffice = auth()->user()->office_id;

        try {

            if ($selectedRows) {

                if ($byWeek && $byEduType) {

                    $users = User::where('status', true)
                    ->whereNotIn('type', ['إداري'])
                    ->where('office_id', $byOffice)
                    ->where('edu_type', $byEduType)
                    ->orderBy('name', 'asc')
                    ->with(['events' => function ($query) use ($byWeek, $selectedRows) {
                        $query->whereIn('id', $selectedRows)
                            ->where('week_id', $byWeek)
                            ->where('status', true)
                            ->orderBy('start', 'asc');
                    }])
                    ->whereHas('events', function ($query) use ($byWeek, $selectedRows) {
                        $query->whereIn('id', $selectedRows)
                            ->where('week_id', $byWeek)
                            ->where('status', true)
                            ->orderBy('start', 'asc')
                            ->whereHas('task', function ($q) {
                                $q->whereNotIn('name', ['إجازة']);
                            });
                    })
                    ->get();


                    if ($users->count() != null) {
                        $subtasks = Subtask::where('status', 1)->where('office_id', $byOffice)->where('edu_type', $byEduType)->orderBy('position', 'asc')->get();
                        $office = Office::where('id', $byOffice)->first();

                        if ($subtasks->count() == null) {
                            Log::alert(__('site.notSubtasksFound'));
                            $this->alert('error', __('site.notSubtasksFound'), [
                                'position' => 'center',
                                'timer' => 6000,
                                'toast' => true,
                                'text' => null,
                                'showCancelButton' => false,
                                'showConfirmButton' => false,
                            ]);
                        } else {
                            return response()->streamDownload(function () use ($users, $subtasks, $office) {
                                $pdf = PDF::loadView('livewire.backend.events.events_pdf', [
                                    'users' => $users,
                                    'subtasks' => $subtasks,
                                    'office' => $office,
                                ]);
                                return $pdf->stream('events');
                            }, 'events.pdf');
                        }

                    } else {
                        $this->alert('error', __('site.noDataForExport'), [
                            'position' => 'center',
                            'timer' => 3000,
                            'toast' => true,
                            'text' => null,
                            'showCancelButton' => false,
                            'showConfirmButton' => false,
                        ]);
                    }

                } else {
                    $this->alert('error', __('site.selectWeek') . ' وكذلك ' . __('site.selectEduType'), [
                        'position' => 'center',
                        'timer' => 6000,
                        'toast' => true,
                        'text' => null,
                        'showCancelButton' => false,
                        'showConfirmButton' => false,
                    ]);
                }
            } else {
                $this->alert('error', __('site.selectRows'), [
                    'position' => 'center',
                    'timer' => 6000,
                    'toast' => true,
                    'text' => null,
                    'showCancelButton' => false,
                    'showConfirmButton' => false,
                ]);
            }

        } catch (\Throwable$th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

            Log::debug($th->getMessage());

            return $message;
        }
    }

    //Get Semester Active
    public function semesterActive()
    {
        $semester_active = Semester::where('active', 1)->get();
        return $semester_active[0]->id;
    }

    //Get Week Active
    public function weekActive()
    {
        $week_active = Week::where('active', 1)->get();
        return $week_active[0]->id;
    }

    // Get Events Property
    public function getEventsProperty()
    {
        $paginateValue = $this->paginateValue;
        $searchString = $this->searchTerm;
        $byOffice = auth()->user()->office_id;
        $byWeek = $this->byWeek;
        $byEduType = $this->byEduType;
        $byStatus = $this->byStatus;

        $events = Event::where('status', $byStatus)->where('semester_id', $this->semesterActive())
            ->when($byOffice, function ($query) use ($byOffice) {
                $query->where('office_id', $byOffice);
            })
            ->when($byWeek, function ($query) use ($byWeek) {
                $query->where('week_id', $byWeek);
            })->when($byEduType, function ($query) use ($byEduType) {
            $query->whereHas('user', function ($q) use ($byEduType) {
                $q->where('edu_type', $byEduType);
            });
        })
            ->search(trim(($searchString)))
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->latest('created_at')
            ->paginate($paginateValue);

        return $events;
    }

    // public function getTasksProperty()
	// {
    //     $tasks = Task::where('office_id', auth()->user()->office_id)
    //     ->whereStatus(1)->where('level_id' , $this->level_id)
    //     ->orderBy('level_id', 'asc')
    //     ->orderBy('name', 'asc')
    //     ->get();

    //     return $tasks;
	// }

    public function updated()
    {
        $this->getTaskesData();
    }

    public function LevelOption()
    {
        $this->getTaskesData();
    }

    public function getTaskesData()
    {
        $this->tasks = Task::where('office_id', auth()->user()->office_id)
        ->whereStatus(1)->where('level_id' , $this->level_id)
        ->orderBy('level_id', 'asc')
        ->orderBy('name', 'asc')
        ->get();
    }

    public function render()
    {
        $events = $this->events;

        $levels = Level::all();
        $tasks = $this->getTaskesData();

        $users = User::whereStatus(1)->whereNotIn('type', ['إداري'])->where('office_id', auth()->user()->office_id)->orderBy('name', 'asc')->get();
        // $tasks = Task::whereStatus(1)->where('office_id', auth()->user()->office_id)->orderBy('level_id', 'asc')->orderBy('name', 'asc')->get();
        $weeks = Week::whereStatus(1)->where('semester_id', $this->semesterActive())->get();

        $feature = Feature::where('office_id', auth()->user()->office_id)->where('title', 'قفل إدخال الخطط')->first();
        $this->featureValue = $feature->value;

        $educationTypes = [
            [
                'id' => 1,
                'title' => 'الشؤون التعليمية',
            ],
            [
                'id' => 2,
                'title' => 'الشؤون المدرسية',
            ],
        ];

        return view('livewire.backend.events.list-events', [
            'events' => $events,
            'users' => $users,
            'weeks' => $weeks,
            'educationTypes' => $educationTypes,
            'levels' => $levels,
            'tasks' => $tasks,
        ])->layout('layouts.admin');
    }
}
