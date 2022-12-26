<?php

namespace App\Http\Livewire\Backend\Events;

use Livewire\Component;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Week;
use App\Models\School;
use Livewire\WithPagination;
use App\Exports\EventsExport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Events extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $user;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'start';
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

    // Get Events Property
    public function getEventsProperty()
    {
        $events =  Event::with('user')
        ->orWhere(function ($query) {
            $query->whereHas('user', function ($q) {
                $q->where('id', 1);
            });
        })->latest('created_at')->get();

        return $events;
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

    // Get Users Property

    public function getUsersProperty()
    {
        $searchString = $this->searchTerm;

        $users =  User::with('events')
        ->where('name', 'like', '%' . $searchString . '%')
        ->orWhere(function ($query) use ($searchString) {
            $query->whereHas('events', function ($q) use ($searchString) {
                $q->where('title', 'like', '%' . $searchString . '%');
            });
        // })
        // ->orWhere(function ($query) use ($searchString) {
        //     $query->whereHas('week', function ($q) use ($searchString) {
        //         $q->where('title', 'like', '%' . $searchString . '%');
        //     });
        //
        })->orderBy('created_at', 'asc')->latest('created_at')->paginate(5);

        return $users;
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

    public function render()
    {
        $events = $this->events;

        $users = User::all();
        $weeks = Week::all();
        $schools = School::all();

        return view('livewire.backend.events.events', [
            'users' => $users,
            'weeks' => $weeks,
            'schools' => $schools,
        ])->layout('layouts.admin');
    }
}
