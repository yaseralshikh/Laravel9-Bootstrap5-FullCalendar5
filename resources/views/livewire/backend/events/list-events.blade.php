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
                    <h1 class="m-0">Events</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Events</li>
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
                        <button wire:click.prevent='addNewEvent' class="ml-1 btn btn-sm btn-primary">
                            <i class="mr-2 fa fa-plus-circle"
                                aria-hidden="true">
                                <span>Add New Event</span>
                            </i>
                        </button>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm">Action</button>
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" wire:click.prevent="exportExcel" href="#" aria-disabled="true">Export to Excel</a>
                                {{-- <a class="dropdown-item" wire:click.prevent="importExcelForm" href="#">Import from Excel</a> --}}
                                <a class="dropdown-item" wire:click.prevent="exportPDF" href="#">Export to PDF</a>
                                <a class="dropdown-item" wire:click.prevent="userNullPlan" href="#">User Without Plan</a>
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
                            <input type="search" wire:model.debounce.350ms="searchTerm" class="form-control form-control-sm" placeholder="Search for..." value="Lorem ipsum">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        {{-- Week Filter --}}
                        <div>
                            <select name="week_id" wire:model="byWeek" class="form-control form-control-sm mr-5">
                                <option value="" selected>All Weeks</option>
                                @foreach ($weeks as $week)
                                <option value="{{ $week->id }}">{{ $week->title . ' ( ' . $week->semester->school_year . ' )' }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Status Filter --}}
                        <div class="custom-control custom-switch">
                            <input type="checkbox" wire:model="byStatus" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Active Events</label>
                        </div>
                        {{-- Total Events --}}
                        <div>
                            <label class="flex-wrap">Total Events : &nbsp{{ $events->total() }}</label>
                        </div>
                    </div>

                    @if ($selectedRows)
                        <span class="mb-2 text-success">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            selected
                            <span class="text-dark font-weight-bold">{{ count($selectedRows) }}</span> {{ Str::plural('event', count($selectedRows)) }}
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
                                        Name
                                        <span wire:click="sortBy('user_id')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'user_id' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'user_id' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        Specialization
                                        {{-- <span wire:click="sortBy('specialization')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'specialization' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'specialization' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span> --}}
                                    </th>
                                    <th>
                                        Title
                                        {{-- <span wire:click="sortBy('title')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span> --}}
                                    </th>
                                    <th>
                                        Date
                                        <span wire:click="sortBy('title')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    {{-- <th>
                                        days
                                    </th> --}}
                                    <th>
                                        School Week
                                        <span wire:click="sortBy('week_id')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'week_id' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'week_id' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        Status
                                        {{-- <span wire:click="sortBy('status')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'status' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'status' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span> --}}
                                    </th>
                                    <th>
                                        Created At
                                        <span wire:click="sortBy('created_at')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th colspan="2">actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($events as $event)
                                    <tr>
                                        <td scope="col">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" wire:model="selectedRows" value="{{ $event->id }}" class="custom-control-input" id="{{ $event->id }}">
                                                <label class="custom-control-label" for="{{ $event->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $event->user->name }}</td>
                                        <td>{{ $event->user->specialization->name }}</td>
                                        <td style="color: {{ $event->color }};">{{ $event->title }}</td>
                                        <td>{{ Alkoumi\LaravelHijriDate\Hijri::Date('l', $event->start) }}<br>
                                            {{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $event->start) }}<br>
                                            {{ Carbon\Carbon::parse($event->start)->toDateString() }}
                                        </td>
                                        {{-- <td>{{ (Carbon\Carbon::parse($event->end))->diffInDays(Carbon\Carbon::parse($event->start)) }}</td> --}}
                                        <td>{{ $event->week->title . ' (' . $event->week->semester->school_year . ' )' }}</td>
                                        <td>
                                            <span  class="font-weight-bold badge text-white {{ $event->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $event->status() }}
                                            </span>
                                        </td>
                                        <td>{{ Alkoumi\LaravelHijriDate\Hijri::Date('l', $event->created_at) }}<br>
                                            {{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $event->created_at) }}<br>
                                            {{ Carbon\Carbon::parse($event->created_at)->toDateString() }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button wire:click.prevent="edit({{ $event }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                                <button wire:click.prevent="confirmEventRemoval({{ $event->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash bg-danger"></i></button>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center">No Events found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-light">
                    {!! $events->appends(request()->all())->links() !!}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal Create or Update Event -->

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateEvent' : 'createEvent' }}">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal)
                                <span>Edit Event</span>
                            @else
                            <span>Add New Event</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="col-12">
                                <!-- Modal user_id -->
                                <div class="form-group">
                                    <label for="user_id" class="form-label">{{ __('User') }} :</label>

                                    <select name="user_id" wire:model.defer="data.user_id"
                                        class="form-control  @error('user_id') is-invalid @enderror" id="user_id">
                                        <option value="" selected>Choise :</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Modal School Week -->
                                <div class="form-group">
                                    <label for="week_id" class="form-label">{{ __('School Week') }} :</label>

                                    <select name="week_id" wire:model.defer="data.week_id"
                                        class="form-control  @error('week_id') is-invalid @enderror" id="week_id">
                                        <option value="" selected>Choise :</option>
                                        @foreach ($weeks as $week)
                                            <option value="{{ $week->id }}">{{ $week->title . ' ( ' . $week->semester->school_year . ' )' }}</option>
                                        @endforeach
                                    </select>

                                    @error('week_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Modal Event Title -->

                                <div class="form-group">
                                    <label for="title" class="col-form-label">المهمة:</label>

                                    <select name="title" wire:model.defer="data.title"
                                        class="form-control  @error('title') is-invalid @enderror" id="title">
                                        <option value="" selected>Choise :</option>
                                        @foreach ($schools as $school)
                                            <option value="{{ $school->name }}">{{ $school->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Modal Event Start -->

                                <div class="form-group">
                                    <label for="start">Start</label>
                                    <input type="date" tabindex="3" wire:model.defer="data.start" class="form-control @error('start') is-invalid @enderror" id="start" aria-describedby="startHelp" placeholder="Enter start">
                                    @error('start')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal Event End -->
                                {{-- <div class="form-group">
                                    <label for="end">End</label>
                                    <input type="hidden" tabindex="3" wire:model.defer="data.end" class="form-control @error('end') is-invalid @enderror" id="end" aria-describedby="endHelp" placeholder="Enter end">
                                    @error('end')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div> --}}

                            </div>
                        </div>

                        <!-- Modal Event Status -->
                        <div class="form-group clearfix">
                            <label for="statusRadio" class="d-inline">Status :</label>
                            <div class="icheck-primary d-inline ml-2 mr-2">
                                <input type="radio" id="radioPrimary1" wire:model="data.status" value="1">
                                <label for="radioPrimary1">Active</label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2" wire:model="data.status" value="0">
                                <label for="radioPrimary2">InActive</label>
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

    <!-- Modal Delete Event -->

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5>Delete Event</h5>
                </div>

                <div class="modal-body">
                    <h4>Are you sure you want to delete this event?</h4>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> Cancel</button>
                    <button type="button" wire:click.prevent="deleteEvent" class="btn btn-danger"><i class="mr-1 fa fa-trash"></i>Delete Event</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import Excel File -->
    <div class="modal fade" id="importExcelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="importExcel">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Import Excel File
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Excel File -->

                        <div class="form-group">
                            <label for="custom-file">Choose Excel File</label>
                            <div class="mb-3 custom-file">
                                <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input wire:model.defer="excelFile" type="file" class="custom-file-input @error('excelFile') is-invalid @enderror" id="validatedCustomFile" required>
                                    {{-- progres bar --}}
                                    <div x-show.transition="isUploading" class="mt-2 rounded progress progress-sm">
                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`"></div>
                                    </div>
                                </div>
                                @error('excelFile')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="custom-file-label" for="customFile">
                                    @if ($excelFile)
                                        {{ $excelFile->getClientOriginalName() }}
                                    @else
                                        Choose Excel file
                                    @endif
                                </label>
                            </div>

                            <!-- import Options Radios Button -->

                            <div class="mb-0 form-group">
                                <label for="importRadio" class="d-inline">Import As :</label>

                                <div class="icheck-primary d-inline ml-2 mr-2">
                                    <input type="radio" wire:click="importType('addNew')" name="optionsRadiosInline" id="optionsRadiosInline1" value="addNew" checked="checked">
                                    <label for="optionsRadiosInline1">Add New</label>
                                </div>

                                <div class="icheck-primary d-inline">
                                    <input type="radio" wire:click="importType('Update')" name="optionsRadiosInline" id="optionsRadiosInline2" value="Update">
                                    <label for="optionsRadiosInline2">Update</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="mr-1 fa fa-open"></i> Open</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @section('script')

        {{-- <script src="{{ asset('backend/js/jquery.printPage.js') }}" type="text/javascript"></script> --}}

        <script>
            $(document).ready( function() {

                window.addEventListener('hide-form', function (event) {
                    $('#form').modal('hide');
                });

                window.addEventListener('show-form', function (event) {
                    $('#form').modal('show');
                });

                window.addEventListener('hide-modal-show', function (event) {
                    $('#modal-show-event').modal('hide');
                });

                window.addEventListener('show-modal-show', function (event) {
                    $('#modal-show-event').modal('show');
                });

                window.addEventListener('show-delete-modal', function (event) {
                    $('#confirmationModal').modal('show');
                });

                window.addEventListener('hide-delete-modal', function (event) {
                    $('#confirmationModal').modal('hide');
                });

                window.addEventListener('show-import-excel-modal', function (event) {
                    $('#importExcelModal').modal('show');
                });

                window.addEventListener('hide-import-excel-modal', function (event) {
                    $('#importExcelModal').modal('hide');
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
