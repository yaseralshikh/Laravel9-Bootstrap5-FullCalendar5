<?php

namespace App\Http\Livewire\Backend\Features;

use App\Models\Office;
use App\Models\Feature;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Features extends Component
{
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $feature;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'id';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $featureIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteFeatures'];

    public $featureValue = null;

    // Updated Select Page Rows

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->features->pluck('id')->map(function ($id) {
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
		Feature::whereIn('id', $this->selectedRows)->update(['status' => 1]);

        $this->alert('success', __('site.activeSuccessfully'), [
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
		Feature::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', __('site.inActiveSuccessfully'), [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

		$this->reset(['selectPageRows', 'selectedRows']);
	}

    // Delete All Selected Features

    public function deleteFeatures()
    {
        // delete selected Features from database
        Feature::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', __('site.deleteSuccessfully'), [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);

        $this->reset('data');
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

    // show add new Feature form modal

    public function addNewFeature()
    {
        $this->reset('data');
        $this->showEditModal = false;
        $this->data['status'] = 1;
        $this->data['value'] = 0;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create new user

    public function createFeature()
    {
        $validatedData = Validator::make($this->data, [
			'title'                  => 'required|max:255',
			'value'                  => 'required',
			'description'            => 'nullable|max:255',
			'section'                => 'required|max:255',
			'office_id'              => 'required|max:255',
		])->validate();


		Feature::create($validatedData);

        $this->dispatchBrowserEvent('hide-form');

        $this->alert('success', __('site.saveSuccessfully'), [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // show Update new Feature form modal

    public function edit(Feature $feature)
    {
        $this->reset('data');

        $this->showEditModal = true;

        $this->feature = $feature;

        $this->data = $feature->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    // Update Task

    public function updateFeature()
    {
            $validatedData = Validator::make($this->data, [
                'title'                  => 'required|max:255',
                'value'                  => 'required',
                'description'            => 'nullable|max:255',
                'section'                => 'nullable|max:255',
                'office_id'              => 'required|max:255',
            ])->validate();

            $this->feature->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', __('site.updateSuccessfully'), [
                'position'  =>  'top-end',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);
    }

    // Show Modal Form to Confirm Feature Removal

    public function confirmFeatureRemoval($featureId)
    {
        $this->featureIdBeingRemoved = $featureId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete Task

    public function deleteFeature()
    {
        try {
            $feature = Feature::findOrFail($this->featureIdBeingRemoved);

            $feature->delete();

            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->alert('success', __('site.deleteSuccessfully'), [
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

    public function getFeaturesProperty()
	{
        $features = Feature::query()
            ->where('title', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(30);

        return $features;
	}

    public function render()
    {
        $features = $this->features;
        $offices = Office::whereStatus(true)->get();

        return view('livewire.backend.features.features', compact(
            'features',
            'offices',
        ))->layout('layouts.admin');
    }
}
