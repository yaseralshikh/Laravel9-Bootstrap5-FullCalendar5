<?php

namespace App\Http\Livewire\Backend\Specializations;

use Livewire\Component;
use App\Models\Specialization;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Specializations extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $specialization;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'name';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $specializationIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteSpecializations'];

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

    // set All selected Specialization As Active

    public function setAllAsActive()
	{
		Specialization::whereIn('id', $this->selectedRows)->update(['status' => 1]);

        $this->alert('success', 'Specializations set As Active successfully.', [
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
		Specialization::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', 'Specializations set As Inactive successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // Delete Selected Specializations

    public function deleteSpecializations()
    {
        // delete selected Specializations from database
        Specialization::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', 'All selected Specializations got deleted.', [
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

    // show add new Specialization form modal

    public function addNewSpecialization()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create new user

    public function createSpecialization()
    {
        $validatedData = Validator::make($this->data, [
			'name'                  => 'required',
		])->validate();


		Specialization::create($validatedData);

        $this->dispatchBrowserEvent('hide-form');

        $this->alert('success', 'Specialization Added Successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // show Update new Specialization form modal

    public function edit(Specialization $specialization)
    {
        $this->reset();

        $this->showEditModal = true;

        $this->specialization = $specialization;

        $this->data = $specialization->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    // Update Specialization

    public function updateSpecialization()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'name'                      => 'required',
            ])->validate();

            $this->specialization->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', 'Specialization updated Successfully.', [
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

    // Show Modal Form to Confirm Specialization Removal

    public function confirmSpecializationRemoval($specializationId)
    {
        $this->specializationIdBeingRemoved = $specializationId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete Task

    public function deleteSpecialization()
    {
        try {
            $specialization = Specialization::findOrFail($this->specializationIdBeingRemoved);

            $specialization->delete();

            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->alert('success', 'Specialization Deleted Successfully.', [
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

    public function getSpecializationsProperty()
	{
        $specializations = Specialization::query()
            ->where('name', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(30);

        return $specializations;
	}

    public function render()
    {
        $specializations = $this->specializations;

        return view('livewire.backend.specializations.specializations',[
            'specializations' => $specializations,
        ])->layout('layouts.admin');
    }
}
