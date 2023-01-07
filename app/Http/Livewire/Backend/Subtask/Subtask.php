<?php

namespace App\Http\Livewire\Backend\Subtask;

use App\Models\Subtask as ModelsSubtask;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Subtask extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $subtask;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'position';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $subtaskIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteSubtasks'];

    // Updated Select Page Rows

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->subtasks->pluck('id')->map(function ($id) {
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

    // set All selected Subtasks As Active

    public function setAllAsActive()
	{
		ModelsSubtask::whereIn('id', $this->selectedRows)->update(['status' => 1]);

        $this->alert('success', 'Subtasks set As Active successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // set All selected Subtasks As InActive

	public function setAllAsInActive()
	{
		ModelsSubtask::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', 'Subtasks set As Inactive successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // Delete Selected Subtasks

    public function deleteSubtasks()
    {
        // delete selected Subtasks from database
        ModelsSubtask::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', 'All selected Subtasks got deleted.', [
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

    // show add new Subtask form modal

    public function addNewSubtask()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create new Subtask

    public function createSubtask()
    {
        $validatedData = Validator::make($this->data, [
			'title'                  => 'required',
		])->validate();

        $validatedData['position'] = 0;

		ModelsSubtask::create($validatedData);

        $this->dispatchBrowserEvent('hide-form');

        $this->alert('success', 'Subtask Added Successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // show Update Subtask form modal

    public function edit(ModelsSubtask $subtask)
    {
        $this->reset();

        $this->showEditModal = true;

        $this->subtask = $subtask;

        $this->data = $subtask->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    // Update Subtask

    public function updateSubtask()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'title'    => 'required',
            ])->validate();

            $this->subtask->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', 'Subtask updated Successfully.', [
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

    // Show Modal Form to Confirm Subtask Removal

    public function confirmSubtaskRemoval($subtaskId)
    {
        $this->subtaskIdBeingRemoved = $subtaskId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete Subtask

    public function deleteSubtask()
    {
        try {
            $subtask = ModelsSubtask::findOrFail($this->subtaskIdBeingRemoved);

            $subtask->delete();

            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->alert('success', 'Subtask Deleted Successfully.', [
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

    // get Subtasks Property

    public function getSubtasksProperty()
	{
        $subtasks = ModelsSubtask::query()
            ->where('title', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(30);

        return $subtasks;
	}


    // Render Subtasks

    public function render()
    {
        $subtasks = $this->subtasks;

        return view('livewire.backend.subtask.subtask',[
            'subtasks' => $subtasks,
        ])->layout('layouts.admin');
    }
}
