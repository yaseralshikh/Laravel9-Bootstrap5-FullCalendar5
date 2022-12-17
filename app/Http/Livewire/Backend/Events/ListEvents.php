<?php

namespace App\Http\Livewire\Backend\Events;

use PDF;
use App\Models\Event;
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
    public $event;

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

    // Updated Search Term
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function getEventsProperty()
	{
        // $events = Event::query()
        // ->where('title', 'like', '%'.$this->searchTerm.'%')
        // ->orderBy($this->sortColumnName, $this->sortDirection)
        // ->latest('created_at')
        // ->paginate(15);

        $searchString = $this->searchTerm;

        $events =  Event::with('user')
        ->where('title', 'like', '%' . $searchString . '%')
        ->orWhere('semester', 'like', '%' . $searchString . '%')
        ->orWhere(function ($query) use ($searchString) {
            $query->whereHas('user', function ($q) use ($searchString) {
                $q->where('name', 'like', '%' . $searchString . '%');
            });
        })->orderBy($this->sortColumnName, $this->sortDirection)->latest('created_at')->paginate(100);

        return $events;
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
			'title'                  => 'required',
			'semester'               => 'required',
			'start'                  => 'required',
			'end'                    => 'required',
            'status'                 => 'required',
		])->validate();


		$event = Event::create($validatedData);

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

		$this->dispatchBrowserEvent('show-form');
    }

    // Update Event

    public function updateEvent()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'title'                  => 'required',
                'semester'               => 'required',
                'start'                  => 'required',
                'end'                    => 'required',
                'status'                 => 'required',
            ])->validate();

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
        return Excel::download(new EventsExport($this->searchTerm,$this->selectedRows), 'events.xlsx');
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

    public function exportPDF()
    {
        return response()->streamDownload(function(){
            if ($this->selectedRows) {
                $events = Event::whereIn('id', $this->selectedRows)->orderBy('title', 'asc')->get();
            } else {
                //$users = $this->users;
                $events = Event::orderBy('name', 'asc')->get();
            }
            $pdf = PDF::loadView('livewire.backend.events.events_pdf',['users' => $events]);
            return $pdf->stream('events');
        },'events.pdf');
    }

    public function render()
    {
        $events = $this->events;
        return view('livewire.backend.events.list-events',[
            'events' => $events,
        ])->layout('layouts.admin');
    }
}
