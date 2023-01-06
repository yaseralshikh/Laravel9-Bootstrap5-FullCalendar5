<?php

namespace App\Http\Livewire\Backend\Weeks;

use App\Models\Week;
use App\Models\Semester;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Weeks extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $week;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'start';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $weekIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteWeeks'];

    // Updated Select Page Rows

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->weeks->pluck('id')->map(function ($id) {
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

    // set All selected User As Active

    public function setAllAsActive()
	{
		Week::whereIn('id', $this->selectedRows)->update(['status' => 1]);

        $this->alert('success', 'Weeks set As Active successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // set All selected User As InActive

	public function setAllAsInActive()
	{
		Week::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', 'Weeks set As Inactive successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // Delete Selected User with relationship roles And permission

    public function deleteWeeks()
    {
        // delete selected users from database
		Week::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', 'All selected weeks got deleted.', [
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

    // show add new user form modal

    public function addNewWeek()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create new user

    public function createWeek()
    {
        $validatedData = Validator::make($this->data, [
            'title'                    => 'required',
            'start'                    => 'required|date',
            'end'                      => 'required|date',
            'semester_id'              => 'required',
		])->validate();


		Week::create($validatedData);

        $this->dispatchBrowserEvent('hide-form');

        $this->alert('success', 'Week Added Successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // show Update new user form modal

    public function edit(Week $week)
    {
        $this->reset();

        $this->showEditModal = true;

        $this->week = $week;

        $this->data = $week->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    // Update Week

    public function updateWeek()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'title'                    => 'required',
                'start'                    => 'required|date',
                'end'                      => 'required|date',
                'semester_id'              => 'required',
            ])->validate();

            $this->week->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', 'Week updated Successfully.', [
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

    // Show Modal Form to Confirm Week Removal

    public function confirmWeekRemoval($weekId)
    {
        $this->weekIdBeingRemoved = $weekId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete Week

    public function deleteWeek()
    {
        try {
            $week = Week::findOrFail($this->weekIdBeingRemoved);

            $week->delete();

            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->alert('success', 'Week Deleted Successfully.', [
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

    public function getWeeksProperty()
	{
        $weeks = Week::query()
            ->where('title', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('start', 'like', '%'.$this->searchTerm.'%')
            ->orWhere('end', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(30);

        return $weeks;
	}
    public function render()
    {
        $weeks = $this->weeks;
        $semesters = Semester::all();

        return view('livewire.backend.weeks.weeks',[
            'weeks' => $weeks,
            'semesters' => $semesters,
        ])->layout('layouts.admin');
    }
}
