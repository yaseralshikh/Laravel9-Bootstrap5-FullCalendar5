<?php

namespace App\Http\Livewire\Backend\Events;

use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Week;
use App\Models\Event;
use App\Models\School;
use App\Models\Subtask;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\EventsExport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ListEvents extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];

    public $items = [];

    public $event;

    public $byWeek = null; //filter by week_id
    public $byStatus = 0; // filter bt status

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'created_at';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $eventIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteEvents'];

    public $excelFile = Null;
    public $importTypevalue = 'addNew';

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

        $this->alert('success', 'Events set As Active successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // set All selected Event As InActive

	public function setAllAsInActive()
	{
		Event::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', 'Events set As Inactive successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // Delete Selected Event

    public function deleteEvents()
    {
        // delete selected events from database
		Event::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', 'All selected events got deleted.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset();
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
    // Swap filter by status

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
        $this->reset();
        $this->showEditModal = false;
        $this->data['status'] = 1;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create new Event

    public function createEvent()
    {
        $validatedData = Validator::make($this->data, [
			'title'                  => 'required|max:255',
			'user_id'               => 'required',
			'week_id'               => 'required',
			'start'                  => 'required',
			//'end'                    => 'required',
            'status'                 => 'required',
		])->validate();

        switch ($validatedData['title']) {
            case "يوم مكتبي":
                $color = '#000000';
              break;
            case "برنامج تدريبي":
                $color = '#eb6c0c';
              break;
            case "إجازة مطولة":
                $color = '#cf87fa';
              break;
            default:
                $color = '#298A08';
        }

        // $user = User::where('id', $validatedData['user_id'])->first();

        // $username = $user->name;
        // $username = explode(' ', $username);

        // $firstName = $username[0];
        // $lastName = (isset($username[count($username)-1])) ? $username[count($username)-1] : '';

        // $validatedData['title'] = $validatedData['title'] . ' - ' . $firstName . ' '. $lastName;

        $validatedData['color'] = $color;


        $validatedData['end'] = date('Y-m-d', strtotime($validatedData['start']. ' + 1 days'));
		Event::create($validatedData);

        $this->dispatchBrowserEvent('hide-form');

        $this->alert('success', 'Event Added Successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // show Update new event form modal

    public function edit(Event $event)
    {
        $this->reset();

		$this->showEditModal = true;

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
                'title'                  => 'required|max:255',
                'user_id'               => 'required',
                'week_id'               => 'required',
                'start'                  => 'required',
                //'end'                    => 'required',
                'status'                 => 'required',
            ])->validate();

            switch ($validatedData['title']) {
                case "يوم مكتبي":
                    $color = '#000000';
                  break;
                case "برنامج تدريبي":
                    $color = '#eb6c0c';
                  break;
                case "إجازة مطولة":
                    $color = '#cf87fa';
                  break;
                default:
                    $color = '#298A08';
            }

            $validatedData['color'] = $color;


            $validatedData['end'] = date('Y-m-d', strtotime($validatedData['start']. ' + 1 days'));

            $this->event->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', 'Event updated Successfully.', [
                'position'  =>  'top-end',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);

        } catch (\Throwable $th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position'  =>  'top-end',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
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

            $this->alert('success', 'Event Deleted Successfully.', [
                'position'  =>  'top-end',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);

        } catch (\Throwable $th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position'  =>  'top-end',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);
            return $message;
        }
    }

    // Export Excel File
    public function exportExcel()
    {
        return Excel::download(new EventsExport($this->searchTerm,$this->selectedRows,$this->byWeek,$this->byStatus), 'events.xlsx');
    }

    // Show Import Excel Form

    public function importExcelForm()
    {
        $this->reset();
		$this->dispatchBrowserEvent('show-import-excel-modal');
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

        if ($byWeek) {

            $users = User::where('status',true)->with(['events' => function ($query) use ($byWeek) {
                $query->where('week_id', $byWeek)->where('status', true)->orderBy('start', 'asc');
            }])->get();

            array_push($this->items , '<b dir="rtl">' .'مشروفن بدون خطط او خططهم غير مكتملة !' . "</b><br><br>");
            array_push($this->items, '<ol dir="rtl">');

            foreach ($users as $user) {
                if ($user->events->count() == Null || $user->events->count() < 5) {
                    $this->items[] = '<li>' . $user->name . "</li><br>";
                }
            }

            array_push($this->items, '</ol>');

            if ($this->items != Null) {
                $this->alert('error', implode(" ", $this->items) , [
                    'position'  =>  'center',
                    'timer'  =>  null,
                    'toast'  =>  true,
                    'text'  =>  null,
                    'showCancelButton'  =>  false,
                    'showConfirmButton'  =>  true
                ]);

                $this->items = [];

            } else {
                $this->alert('success', 'All User has Events', [
                    'position'  =>  'top-end',
                    'timer'  =>  3000,
                    'toast'  =>  true,
                    'text'  =>  null,
                    'showCancelButton'  =>  false,
                    'showConfirmButton'  =>  false
                ]);
            }

        } else {
            $this->alert('error', 'Select Week befor that !', [
                'position'  =>  'center',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);
        }
    }

    public function exportPDF()
    {
        $byWeek = $this->byWeek;

        if ($byWeek) {
            $users = User::where('status',true)->orderBy('name', 'asc')->whereHas('events', function ($query) use ($byWeek) {
                $query->where('week_id', $byWeek)->where('status', true);
            })->with(['events' => function ($query) use ($byWeek) {
                $query->where('week_id', $byWeek)->where('status', true)->whereNotIn('title', ['إجازة'])->orderBy('start', 'asc');
            }])->get();

            if ($users->count() != Null) {
                $subtasks = Subtask::where('status',1)->orderBy('position', 'asc')->get();
                return response()->streamDownload(function() use($users, $subtasks){
                    $pdf = PDF::loadView('livewire.backend.events.events_pdf',[
                        'users' => $users,
                        'subtasks' => $subtasks,
                    ]);
                    return $pdf->stream('events');
                },'events.pdf');
            } else {
                $this->alert('error', 'Thay are no events to do that !', [
                    'position'  =>  'center',
                    'timer'  =>  3000,
                    'toast'  =>  true,
                    'text'  =>  null,
                    'showCancelButton'  =>  false,
                    'showConfirmButton'  =>  false
                ]);
            }

        } else {
            $this->alert('error', 'Select Week befor that !', [
                'position'  =>  'center',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);
        }
    }

    // Get Events Property

    public function getEventsProperty()
	{
        $searchString = $this->searchTerm;
        $byWeek = $this->byWeek;
        $byStatus = $this->byStatus;

        $events = Event::where('status', $byStatus)->when($byWeek, function($query) use ($byWeek){
            $query->where('week_id', $byWeek);
        })
        ->search(trim(($searchString)))
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->latest('created_at')
        ->paginate(100);

        return $events;
	}

    public function render()
    {
        $events = $this->events;
        $users = User::where('status',1)->get();

        // $userPlans = User::where('status', true)
        // ->where(function ($query) {
        //     $query->whereHas('events', function ($q) {
        //         $q->where('week_id', $this->semesterActive());
        //     });
        // })->get();

        $weeks = Week::where('status',1)->get();
        $schools = School::where('status',1)->get();

        return view('livewire.backend.events.list-events',[
            'events' => $events,
            'users' => $users,
            'weeks' => $weeks,
            'schools' => $schools,
        ])->layout('layouts.admin');
    }
}
