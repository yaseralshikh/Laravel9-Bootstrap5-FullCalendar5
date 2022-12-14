<?php

namespace App\Http\Livewire\Backend\Levels;

use Livewire\Component;
use App\Models\Level;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Levels extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $level;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'id';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $levelIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteLevels'];

    // Updated Select Page Rows

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->levels->pluck('id')->map(function ($id) {
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
		Level::whereIn('id', $this->selectedRows)->update(['status' => 1]);

        $this->alert('success', 'Levels set As Active successfully.', [
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
		Level::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', 'Levels set As Inactive successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // Delete Selected Levels

    public function deleteLevels()
    {
        // delete selected Levels from database
        Level::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', 'All selected Levels got deleted.', [
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

    // show add new Level form modal

    public function addNewLevel()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create new user

    public function createLevel()
    {
        $validatedData = Validator::make($this->data, [
			'name'                  => 'required',
		])->validate();


		Level::create($validatedData);

        $this->dispatchBrowserEvent('hide-form');

        $this->alert('success', 'Level Added Successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // show Update new Level form modal

    public function edit(Level $level)
    {
        $this->reset();

        $this->showEditModal = true;

        $this->level = $level;

        $this->data = $level->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    // Update Task

    public function updateLevel()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'name'                      => 'required',
            ])->validate();

            $this->level->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', 'Level updated Successfully.', [
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

    // Show Modal Form to Confirm Level Removal

    public function confirmLevelRemoval($levelId)
    {
        $this->levelIdBeingRemoved = $levelId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete Task

    public function deleteLevel()
    {
        try {
            $level = Level::findOrFail($this->levelIdBeingRemoved);

            $level->delete();

            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->alert('success', 'Level Deleted Successfully.', [
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

    public function getLevelsProperty()
	{
        $levels = Level::query()
            ->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(30);

        return $levels;
	}

    public function render()
    {
        $levels = $this->levels;

        return view('livewire.backend.levels.levels',[
            'levels'    => $levels,
        ])->layout('layouts.admin');
    }
}
