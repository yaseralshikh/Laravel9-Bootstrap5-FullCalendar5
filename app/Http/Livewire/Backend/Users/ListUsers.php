<?php

namespace App\Http\Livewire\Backend\Users;

use App\Models\User;
use Livewire\Component;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PDF;

class ListUsers extends Component
{

    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;

    protected $paginationTheme = 'bootstrap';

    public $data = [];
    public $user;

    public $searchTerm = null;
    protected $queryString = ['searchTerm' => ['except' => '']];

    public $sortColumnName = 'name';
    public $sortDirection = 'asc';

    public $showEditModal = false;

    public $userIdBeingRemoved = null;

    public $selectedRows = [];
	public $selectPageRows = false;
    protected $listeners = ['deleteConfirmed' => 'deleteUsers'];

    public $excelFile = Null;
    public $importTypevalue = 'addNew';

    // Updated Select Page Rows

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->users->pluck('id')->map(function ($id) {
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

    // set All selected User As Active

    public function setAllAsActive()
	{
		User::whereIn('id', $this->selectedRows)->update(['status' => 1]);

        $this->alert('success', 'Users set As Active successfully.', [
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
		User::whereIn('id', $this->selectedRows)->update(['status' => 0]);

        $this->alert('success', 'Users set As Inactive successfully.', [
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

    public function deleteUsers()
    {
        // delete roles and permissions for selected users from database
        DB::table('role_user')->whereIn('user_id', $this->selectedRows)->delete();
        DB::table('permission_user')->whereIn('user_id', $this->selectedRows)->delete();

        // delete selected users from database
		User::whereIn('id', $this->selectedRows)->delete();

        $this->alert('success', 'All selected users got deleted.', [
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

    //  Filter Users By Roles

    public function filterUsersByRoles($roleFilter = null)
    {
        $this->roleFilter = $roleFilter;
    }

    // show add new user form modal

    public function addNewUser()
    {
        $this->reset();
        $this->showEditModal = false;
        $this->data['role_id'] = 3;
        $this->data['status'] = 1;
        $this->dispatchBrowserEvent('show-form');
    }

    // Create new user

    public function createUser()
    {
        $validatedData = Validator::make($this->data, [
			'name'                  => 'required',
			'specialization_id'     => 'required',
			'email'                 => 'required|email|unique:users',
			'password'              => 'required|confirmed',
            'status'                => 'required',
		])->validate();

		$validatedData['password'] = bcrypt($validatedData['password']);

		$user = User::create($validatedData);
        $user->attachRole(3);

        $this->dispatchBrowserEvent('hide-form');

        $this->alert('success', 'User Added Successfully.', [
            'position'  =>  'top-end',
            'timer'  =>  3000,
            'toast'  =>  true,
            'text'  =>  null,
            'showCancelButton'  =>  false,
            'showConfirmButton'  =>  false
        ]);
    }

    // show Update new user form modal

    public function edit(User $user)
    {
        $this->reset();

		$this->showEditModal = true;

		$this->user = $user;

		$this->data = $user->toArray();

		$this->dispatchBrowserEvent('show-form');
    }

    // Update User

    public function updateUser()
    {
        try {
            $validatedData = Validator::make($this->data, [
                'name'                      => 'required',
                'specialization_id'            => 'required',
                'email'                     => 'required|email|unique:users,email,'.$this->user->id,
                'status'                    => 'required',
                'password'                  => 'sometimes|confirmed',
            ])->validate();

            if(!empty($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }


            $this->user->update($validatedData);

            $this->dispatchBrowserEvent('hide-form');

            $this->alert('success', 'User updated Successfully.', [
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

    // Show user details

    public function show(User $user)
    {
        $this->reset();

		$this->user = $user;

		$this->data = $user->toArray();

        $this->data['role_id'] = $user->roles[0]->id;

        $this->data['created_at'] = $user->created_at->format('d-m-Y');

		$this->dispatchBrowserEvent('show-modal-show');
    }

    // Show Modal Form to Confirm User Removal

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved = $userId;

        $this->dispatchBrowserEvent('show-delete-modal');
    }

    // Delete User

    public function deleteUser()
    {
        try {
            $user = User::findOrFail($this->userIdBeingRemoved);

            // delete roles and permissions for selected users from database
            DB::table('role_user')->where('user_id', $this->userIdBeingRemoved)->delete();
            DB::table('permission_user')->where('user_id', $this->userIdBeingRemoved)->delete();

            $user->delete();

            $this->dispatchBrowserEvent('hide-delete-modal');

            $this->alert('success', 'User Deleted Successfully.', [
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
        return Excel::download(new UsersExport($this->searchTerm,$this->selectedRows), 'users.xlsx');
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
        try {

            $this->validate([
                'excelFile' => 'required|mimes:xls,xlsx'
            ]);

            if ($this->importTypevalue == 'addNew') {
                Excel::import(new UsersImport, $this->excelFile);
            } else {
                // for update data
                $usersData = Excel::toCollection(new UsersImport(), $this->excelFile);
                foreach ($usersData[0] as $user) {
                    User::where('id', $user['id'])->update([
                        'name'              => $user['name'],
                        'email'             => $user['email'],
                        'specialization_id' => $user['specialization_id'],
                        'status'            => $user['status'],
                        'password'          => Hash::make($user['password']),
                    ]);
                }
            }

            // method for add Roles to nwe users added
            $usersDoesntHaveRole = User::whereDoesntHave('roles')->get();

            foreach ($usersDoesntHaveRole as $user) {
                DB::table('role_user')->insert([
                    'role_id' => 3,
                    'user_id' => $user->id,
                    'user_type' => 'App\Models\User'
                ]);
            }

            // end method

            $this->alert('success', 'Users Added Successfully.', [
                'position'  =>  'top-end',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);

            $this->reset();
            $this->dispatchBrowserEvent('hide-import-excel-modal');


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

            $this->importType = null;
            $this->reset();
            $this->dispatchBrowserEvent('hide-import-excel-modal');
        }
    }

    public function exportPDF()
    {
        return response()->streamDownload(function(){
            if ($this->selectedRows) {
                $users = User::whereIn('id', $this->selectedRows)->orderBy('name', 'asc')->get();
            } else {
                //$users = $this->users;
                $users = User::orderBy('name', 'asc')->get();
            }
            $pdf = PDF::loadView('livewire.backend.users.users_pdf',['users' => $users]);
            return $pdf->stream('users');
        },'users.pdf');
    }

    public function getUsersProperty()
	{
        $users = User::query()
        ->where('name', 'like', '%'.$this->searchTerm.'%')
        ->orderBy($this->sortColumnName, $this->sortDirection)
        ->paginate(15);

        return $users;
	}

    public function render()
    {
        $users = $this->users;

        $specializations = Specialization::where('status',1)->get();
        return view('livewire.backend.users.list-users',[
            'users' => $users,
            'specializations' => $specializations ,
        ])->layout('layouts.admin');
    }
}
