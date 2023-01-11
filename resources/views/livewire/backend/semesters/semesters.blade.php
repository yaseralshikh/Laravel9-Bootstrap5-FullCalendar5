<div>
    @section('style')
        <style>
            .disabled-link{
                cursor: default;
                pointer-events: none;
                text-decoration: none;
                color: rgb(174, 172, 172);
            }
        </style>
    @endsection

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1 class="m-0">Semesters</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Semesters</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title">
                        <button wire:click.prevent='addNewSemester' class="ml-1 btn btn-sm btn-primary">
                            <i class="mr-2 fa fa-plus-circle"
                                aria-hidden="true">
                                <span>Add New Semester</span>
                            </i>
                        </button>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm">Action</button>
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                {{-- <a class="dropdown-item" wire:click.prevent="exportExcel" href="#" aria-disabled="true">Export to Excel</a> --}}
                                {{-- <a class="dropdown-item" wire:click.prevent="exportPDF" href="#">Export to PDF</a> --}}
                                <div class="dropdown-divider"></div>
                                {{-- @if ($selectedRows) --}}
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}" wire:click.prevent="setAllAsActive" href="#">Set as Acive</a>
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}" wire:click.prevent="setAllAsInActive" href="#">Set as InActive</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ $selectedRows ? 'text-danger' : 'disabled-link' }}  delete-confirm" wire:click.prevent="deleteSelectedRows" href="#">Delete Selected</a>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group d-flex justify-content-between align-items-center">
                        {{-- search --}}
                        <div class="input-group" style="width: 200px;">
                            <input type="search" wire:model="searchTerm" class="form-control" placeholder="Search for..." value="Lorem ipsum">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Status Filter --}}
                        <div class="custom-control custom-switch">
                            <input type="checkbox" wire:model="byStatus" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">InActive Semesters</label>
                        </div>

                        <label class="flex-wrap">Total Semesters : &nbsp{{ $semesters->total() }}</label>

                    </div>

                    @if ($selectedRows)
                        <span class="mb-2 text-success">
                            <i class="fa fa-level" aria-hidden="true"></i>
                            selected
                            <span class="text-dark font-weight-bold">{{ count($selectedRows) }}</span> {{ Str::plural('semester', count($selectedRows)) }}
                            <a class="ml-2 text-gray" href="" wire:click="resetSelectedRows" data-toggle="tooltip" data-placement="top" title="Reset Selected Rows"><i class="fas fa-times"></i></a>
                        </span>
                    @endif

                    <div class="table-responsive">
                        <table id="example2"  class="table text-center table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" wire:model="selectPageRows" value="" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>
                                        Semester Title
                                        <span wire:click="sortBy('title')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        Semester Start
                                    </th>
                                    <th>
                                        Semester End
                                    </th>
                                    <th>
                                        School Year
                                        <span wire:click="sortBy('school_year')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'school_year' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'school_year' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        Active
                                    </th>
                                    <th>
                                        Status
                                        <span wire:click="sortBy('status')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'status' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'status' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th colspan="2">actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($semesters as $semester)
                                    <tr>
                                        <td scope="col">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" wire:model="selectedRows" value="{{ $semester->id }}" class="custom-control-input" id="{{ $semester->id }}">
                                                <label class="custom-control-label" for="{{ $semester->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="dtr-control sorting_1" tabindex="1">{{ $semester->title }}</td>
                                        <td class="dtr-control sorting_1" tabindex="2">
                                            {{ $semester->start }}<br>
                                            {{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $semester->start) }}
                                        </td>
                                        <td class="dtr-control sorting_1" tabindex="3">
                                            {{ $semester->end }}<br>
                                            {{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $semester->end) }}
                                        </td>
                                        <td class="dtr-control sorting_1" tabindex="4">{{ $semester->school_year }}</td>
                                        <td>
                                            <div class="form-check">
                                                <input wire:change="changeActive({{ $semester->id }})" class="form-check-input" type="checkbox" {{ $semester->active ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <span  class="font-weight-bold badge text-white {{ $semester->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $semester->status() }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button wire:click.prevent="edit({{ $semester }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                                @if (auth()->user()->roles[0]->name == 'superadmin')
                                                    <button wire:click.prevent="confirmSemesterRemoval({{ $semester->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash bg-danger"></i></button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash bg-danger"></i></button>
                                                @endif
                                            </div>
                                            {{-- <form action="" method="post" id="delete-semester-{{ $semester->id }}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No Semesters found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="5">
                                        {!! $semesters->appends(request()->all())->links() !!}
                                    </td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-light">
                    {!! $semesters->appends(request()->all())->links() !!}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal Create or Update semester -->

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateSemester' : 'createSemester' }}">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal)
                                <span>Edit Semester</span>
                            @else
                                <span>Add New Semester</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="col-12">
                                <!-- Modal Semester Name -->
                                <div class="form-group">
                                    <label for="title">Semester title</label>
                                    <input type="text" tabindex="1" wire:model.defer="data.title" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="titleHelp" placeholder="Enter title">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Modal Semester Start -->
                                <div class="form-group">
                                    <label for="start">Semester Start</label>
                                    <input type="date" tabindex="2" wire:model.defer="data.start" class="form-control @error('start') is-invalid @enderror" id="start" aria-describedby="startHelp" placeholder="Enter start date">
                                    @error('start')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Modal Semester End -->
                                <div class="form-group">
                                    <label for="end">Semester End</label>
                                    <input type="date" tabindex="3" wire:model.defer="data.end" class="form-control @error('end') is-invalid @enderror" id="end" aria-describedby="endHelp" placeholder="Enter end date">
                                    @error('end')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- Modal school_year -->
                                <div class="form-group">
                                    <label for="school_year">School Year</label>
                                    <input type="number" tabindex="4" wire:model.defer="data.school_year" class="form-control @error('school_year') is-invalid @enderror" id="school_year" aria-describedby="school_yearHelp" placeholder="Enter school year">
                                    @error('school_year')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="mr-1 fa fa-save"></i>
                            @if ($showEditModal)
                                <span>Save Changes</span>
                            @else
                            <span>Save</span>
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete Semester -->

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5>Delete Semester</h5>
                </div>

                <div class="modal-body">
                    <h4>Are you sure you want to delete this semester?</h4>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> Cancel</button>
                    <button type="button" wire:click.prevent="deleteSemester" class="btn btn-danger"><i class="mr-1 fa fa-trash"></i>Delete Semester</button>
                </div>
            </div>
        </div>
    </div>

    @section('script')

        <script>
            $(document).ready( function() {
                window.addEventListener('hide-form', function (event) {
                    $('#form').modal('hide');
                });
                window.addEventListener('show-form', function (event) {
                    $('#form').modal('show');
                });
                window.addEventListener('show-delete-modal', function (event) {
                    $('#confirmationModal').modal('show');
                });
                window.addEventListener('hide-delete-modal', function (event) {
                    $('#confirmationModal').modal('hide');
                });
            });
        </script>

        {{-- show-delete-alert-confirmation --}}

        <script>
            window.addEventListener('show-delete-alert-confirmation', event =>{
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteConfirmed')
                    }
                })
            })
        </script>

    @endsection

</div>
