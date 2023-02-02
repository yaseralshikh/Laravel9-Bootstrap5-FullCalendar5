<?php

namespace App\Http\Livewire\Backend\Offices;

use App\Models\Office as ModelsOffice;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Office extends Component
{
    use WithFileUploads;
    use WithPagination;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $office;

    public $director_signature_image;
    public $assistant_signature_image;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $byStatus = 1;

    public $sortColumnName = 'name';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $officeIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteOffices'];

    // Updated Select Page Rows

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->offices->pluck('id')->map(function ($id) {
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
		ModelsOffice::whereIn('id', $this->selectedRows)->update(['status' => 1]);

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
		ModelsOffice::whereIn('id', $this->selectedRows)->update(['status' => 0]);

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

        // Delete Selected Offices

        public function deleteOffices()
        {
            // delete images for offices if exists from Storage folder
            $signatureImages = ModelsOffice::whereIn('id', $this->selectedRows)->get(['director_signature_path']);
            foreach($signatureImages as $signatureImage){
                $imageFileName = $signatureImage->director_signature_path;
                if($imageFileName){
                    Storage::disk('signature_photos')->delete($imageFileName);
                }
            }

            $signatureImages = ModelsOffice::whereIn('id', $this->selectedRows)->get(['assistant_signature_path']);
            foreach($signatureImages as $signatureImage){
                $imageFileName = $signatureImage->assistant_signature_path;
                if($imageFileName){
                    Storage::disk('signature_photos')->delete($imageFileName);
                }
            }

            // delete selected Offices from database
            ModelsOffice::whereIn('id', $this->selectedRows)->delete();

            $this->alert('success', __('site.deleteSuccessfully'), [
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

    // show add new Office form modal

    public function addNewOffice()
    {
        $this->reset('data');
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createOffice()
    {
        $validatedData = Validator::make($this->data, [
			'name'                      => 'required',
            'director_signature_path'   => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'assistant_signature_path'  => 'image|mimes:jpeg,png,jpg,gif|max:2048',
			'director'                  => 'required',
		])->validate();


        if ($this->director_signature_image) {
            $validatedData['director_signature_path'] = $this->director_signature_image->store('/', 'signature_photos');
		}

        if ($this->assistant_signature_image) {
            $validatedData['assistant_signature_path'] = $this->assistant_signature_image->store('/', 'signature_photos');
		}

		ModelsOffice::create($validatedData);

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

    // show Update new office form modal

    public function edit(ModelsOffice $office)
    {
        $this->reset('data');

        $this->showEditModal = true;

        $this->office = $office;

        $this->data = $office->toArray();

        $this->dispatchBrowserEvent('show-form');
    }

    // Update Task

    public function updateOffice()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'name'                      => 'required',
                'director_signature_path'   => 'max:2048',
                'assistant_signature_path'  => 'max:2048',
                'director'                  => 'required',
            ])->validate();

            if ($this->director_signature_image) {
                if($this->office->director_signature_path){
                    Storage::disk('signature_photos')->delete($this->office->director_signature_path);
                }
                $validatedData['director_signature_path'] = $this->director_signature_image->store('/', 'signature_photos');
            }
            if ($this->assistant_signature_image) {
                if($this->office->assistant_signature_path){
                    Storage::disk('signature_photos')->delete($this->office->assistant_signature_path);
                }
                $validatedData['assistant_signature_path'] = $this->assistant_signature_image->store('/', 'signature_photos');
            }

            $this->office->update($validatedData);

            $this->director_signature_image = null;
            $this->assistant_signature_image = null;

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', __('site.updateSuccessfully'), [
                'position'  =>  'top-end',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);

        } catch (\Throwable $th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position'  =>  'center',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);
            return $message;
        };
    }

    public function removeDirectorImage($officeId)
    {
        try {
            $office = ModelsOffice::findOrFail($officeId);
            $directorFileName = $office->director_signature_path;

            if($directorFileName){
                Storage::disk('signature_photos')->delete($directorFileName);

                $office->update([
                    'director_signature_path' => null,
                ]);

                $this->director_signature_image = null;

                $this->alert('success', __('site.deleteSuccessfully'), [
                    'position'  =>  'center',
                    'timer'  =>  3000,
                    'toast'  =>  true,
                    'text'  =>  null,
                    'showCancelButton'  =>  false,
                    'showConfirmButton'  =>  false
                ]);
            }

        } catch (\Throwable $th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position'  =>  'center',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);
            return $message;
        }
    }

    public function removeAssistantImage($officeId)
    {
        try {
            $office = ModelsOffice::findOrFail($officeId);
            $assistantFileName = $office->assistant_signature_path;

            if($assistantFileName){
                Storage::disk('signature_photos')->delete($assistantFileName);

                $office->update([
                    'assistant_signature_path' => null,
                ]);

                $this->assistant_signature_image = null;

                $this->alert('success', __('site.deleteSuccessfully'), [
                    'position'  =>  'center',
                    'timer'  =>  3000,
                    'toast'  =>  true,
                    'text'  =>  null,
                    'showCancelButton'  =>  false,
                    'showConfirmButton'  =>  false
                ]);
            }

        } catch (\Throwable $th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position'  =>  'center',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);
            return $message;
        }
    }

    // Show Modal Form to Confirm Office Removal

    public function confirmOfficeRemoval($officeId)
    {
        $this->officeIdBeingRemoved = $officeId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete Office

    public function deleteOffice()
    {
        try {
            $office = ModelsOffice::findOrFail($this->officeIdBeingRemoved);

            $directorFileName = $office->director_signature_path;
            $assistantFileName = $office->assistant_signature_path;

            if($directorFileName){
                Storage::disk('signature_photos')->delete($directorFileName);
            }

            if($assistantFileName){
                Storage::disk('signature_photos')->delete($assistantFileName);
            }

            $office->delete();

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

    public function getOfficesProperty()
	{
        $searchString = $this->searchTerm;

        $offices = ModelsOffice::search(trim(($searchString)))
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->orderBy('id','asc')
            ->paginate(30);

        return $offices;
	}

    public function render()
    {
        $offices = $this->offices;
        return view('livewire.backend.offices.office', compact('offices'))->layout('layouts.admin');
    }

}
