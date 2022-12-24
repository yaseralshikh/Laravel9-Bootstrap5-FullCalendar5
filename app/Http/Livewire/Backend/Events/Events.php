<?php

namespace App\Http\Livewire\Backend\Events;

use Livewire\Component;
use PDF;
use Carbon\Carbon;
use App\Models\User;
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

        // Get Events Property

        public function getEventsProperty()
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
            })->orderBy($this->sortColumnName, $this->sortDirection)->latest('created_at')->paginate(100);

            return $users;
        }

    public function render()
    {
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
