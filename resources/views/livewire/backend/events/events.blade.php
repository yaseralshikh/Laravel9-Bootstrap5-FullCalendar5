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
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('site.dashboard')</a></li>
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
                                <a class="dropdown-item" wire:click.prevent="importExcelForm" href="#">Import from Excel</a>
                                <a class="dropdown-item" wire:click.prevent="exportPDF" href="#">Export to PDF</a>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}" wire:click.prevent="setAllAsActive" href="#">Set as Acive</a>
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}" wire:click.prevent="setAllAsInActive" href="#">Set as InActive</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ $selectedRows ? 'text-danger' : 'disabled-link' }}  delete-confirm" wire:click.prevent="deleteSelectedRows" href="#">Delete Selected</a>

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
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group ">
                            {{-- search --}}
                            <div class="input-group" style="width: 200px;">
                                <input type="search" wire:model="searchTerm" class="form-control" placeholder="Search for..." value="Lorem ipsum">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- <label class="flex-wrap">Total Events : &nbsp{{ $users->events->total() }}</label> --}}

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
                                <tr wire:ignore.self>
                                    <th><button type="button" class="btn btn-sm btn-secondary" data-toggle="collapse" data-target=".ShowHide">#</button></th>
                                    <th>Name</th>
                                    <th>Specialization</th>
                                    <th>Email</th>
                                    <th>Events</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr style="background-color: rgb(218, 252, 220)">
                                        <td><button type="button" class="btn btn-sm btn-light" data-toggle="collapse" aria-expanded="true" data-target="#collapseme{{$user->id}}">{{ $loop->iteration }}</button></td>
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $user->name }}</td>
                                        <td>{{ $user->specialization->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->events->count() }}</td>
                                        <td>
                                            <span  class="font-weight-bold badge text-white {{ $user->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $user->status() }}
                                            </span>
                                        </td>
                                    </tr>

                                    @if ($user->events->count())
                                        <tr id="collapseme{{$user->id}}" class="collapse out ShowHide" wire:ignore.self>
                                            <td colspan="7">
                                                <div class="table-responsive">
                                                    <table id="example2"  class="table text-center table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                                        <thead style="background-color: rgb(205, 239, 255)">
                                                            <tr>
                                                                <th scope="col">
                                                                    <div class="custom-control custom-checkbox small">
                                                                        <input type="checkbox" wire:model="selectPageRows" value="" class="custom-control-input" id="customCheck">
                                                                        <label class="custom-control-label" for="customCheck"></label>
                                                                    </div>
                                                                </th>
                                                                <th>#</th>
                                                                <th>Title</th>
                                                                <th>Date</th>
                                                                <th>Week</th>
                                                                <th>Status</th>
                                                                <th colspan="2">actions</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody class="text-center">
                                                            @foreach ($user->events as $event)
                                                                <tr>
                                                                    <td scope="col">
                                                                        <div class="custom-control custom-checkbox small">
                                                                            <input type="checkbox" wire:model="selectedRows" value="{{ $event->id }}" class="custom-control-input" id="{{ $event->id }}">
                                                                            <label class="custom-control-label" for="{{ $event->id }}"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>{{ $loop->iteration }}</td>
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
                                                                    <td>
                                                                        <div class="btn-group btn-group-sm">
                                                                            <button wire:click.prevent="edit({{ $event }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                                                            @if (!auth()->user()->roles[0]->name == 'user')
                                                                                <button wire:click.prevent="confirmEventRemoval({{ $event->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash bg-danger"></i></button>
                                                                            @else
                                                                                <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash bg-danger"></i></button>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                    @dump( $selectPageRows , $selectedRows )
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No Users found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-light">
                    {{-- {!! $users->appends(request()->all())->links() !!} --}}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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

