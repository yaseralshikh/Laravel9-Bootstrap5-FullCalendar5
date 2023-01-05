<?php

namespace App\Http\Livewire\Backend\Tasks;

use App\Models\Level;
use Livewire\Component;
use App\Models\School;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Tasks extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $task;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'name';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $taskIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteTasks'];

    // Updated Select Page Rows

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->tasks->pluck('id')->map(function ($id) {
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
		School::whereIn('id', $this->selectedRows)->update(['status' => 1]);

        $this->alert('success', 'Tasks set As Active successfully.', [
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
		School::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', 'Tasks set As Inactive successfully.', [
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

    public function deleteTasks()
    {
        // delete selected users from database
		School::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', 'All selected tasks got deleted.', [
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

    public function addNewTask()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create new user

    public function createTask()
    {
        $validatedData = Validator::make($this->data, [
			'name'                  => 'required',
			'level_id'              => 'required',
		])->validate();


		School::create($validatedData);

        $this->dispatchBrowserEvent('hide-form');

        $this->alert('success', 'Task Added Successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // show Update new user form modal

    public function edit(School $task)
    {
        $this->reset();

        $this->showEditModal = true;

        $this->task = $task;

        $this->data = $task->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    // Update Task

    public function updateTask()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'name'                      => 'required',
                'level_id'                  => 'required',
            ])->validate();

            $this->task->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', 'Task updated Successfully.', [
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

    // Show Modal Form to Confirm Task Removal

    public function confirmTaskRemoval($taskId)
    {
        $this->taskIdBeingRemoved = $taskId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete Task

    public function deleteTask()
    {
        try {
            $task = School::findOrFail($this->taskIdBeingRemoved);

            $task->delete();

            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->alert('success', 'Task Deleted Successfully.', [
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

    public function getTasksProperty()
	{
        $tasks = School::query()
            ->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(30);

        return $tasks;
	}

    public function render()
    {
        $tasks = $this->tasks;
        $levels = Level::all();

        return view('livewire.backend.tasks.tasks',[
            'tasks'     => $tasks,
            'levels'    => $levels,
        ])->layout('layouts.admin');
    }
}
