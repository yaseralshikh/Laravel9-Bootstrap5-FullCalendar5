<?php

namespace App\Http\Livewire\Backend\Subtask;

use App\Models\Subtask as ModelsSubtask;
use App\Models\Office;
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

    public $byOffice = null; //filter by office_id

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
			'section'                => 'required',
            'office_id'              => 'nullable',
		])->validate();

        $validatedData['position'] = 0;

        if(empty($validatedData['office_id'])) {
            $validatedData['office_id'] = auth()->user()->office_id;
        }

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
                'title'         => 'required',
                'section'       => 'required',
                'office_id'     => 'required',
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

    public function updateSubtaskPosition($items)
    {
        foreach ($items as $item) {
            ModelsSubtask::find($item['value'])->update(['position' => $item['order']]);
        }

        $this->alert('success', 'Subtask position updated Successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // get Subtasks Property

    public function getSubtasksProperty()
	{
        $searchString = $this->searchTerm;
        $byOffice = $this->byOffice ? $this->byOffice : auth()->user()->office_id;

        $subtasks = ModelsSubtask::where('office_id', $byOffice)
            ->search(trim(($searchString)))
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(30);

        return $subtasks;
	}


    // Render Subtasks

    public function render()
    {
        $subtasks = $this->subtasks;
        $offices = Office::whereStatus(true)->get();

        $sections = [
            [
                'id'    => 1,
                'title' => 'مهمة فرعية'
            ],
            [
                'id'    => 2,
                'title' => 'حاشية'
            ],
        ];

        return view('livewire.backend.subtask.subtask',[
            'subtasks' => $subtasks,
            'offices'  => $offices,
            'sections'  => $sections,
        ])->layout('layouts.admin');
    }
}
