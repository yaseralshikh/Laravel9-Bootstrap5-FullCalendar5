<div>
    @section('style')
    <style>
        body {
            font-size: 14px;
        }

        .disabled-link {
            cursor: default;
            pointer-events: none;
            text-decoration: none;
            color: rgb(174, 172, 172);
        }
        .hover-item:hover{
            background-color: rgb(174, 172, 172);
        }
    </style>
    @endsection

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('site.events')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('site.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.events')</li>
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
                            <i class="mr-2 fa fa-plus-circle" aria-hidden="true">
                                <span>@lang('site.addEvent')</span>
                            </i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm">@lang('site.action')</button>
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" wire:click.prevent="userNullPlan"
                                    href="#">@lang('site.userWithoutPlan')</a>
                                <div class="dropdown-divider"></div>
                                <a dir="rtl" class="dropdown-item" wire:click.prevent="exportExcel" href="#"
                                    aria-disabled="true">@lang('site.exportExcel')</a>
                                {{-- <a class="dropdown-item" wire:click.prevent="importExcelForm" href="#">Import from
                                    Excel</a> --}}
                                <a dir="rtl" class="dropdown-item" wire:click.prevent="exportPDF"
                                    href="#">@lang('site.exportPDF')</a>
                                <div class="dropdown-divider"></div>
                                {{-- @if ($selectedRows) --}}
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}"
                                    wire:click.prevent="setAllAsActive" href="#">@lang('site.eventsAcive')</a>
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}"
                                    wire:click.prevent="setAllAsInActive" href="#">@lang('site.eventsInAcive')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ $selectedRows ? 'text-danger' : 'disabled-link' }}  delete-confirm"
                                    wire:click.prevent="deleteSelectedRows" href="#">@lang('site.deleteSelected')</a>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </h3>

                    {{-- <div class="card-tools">
                        <div class="btn-group pr-2">
                            <a href="#" class="btn btn-outline-secondary btn-sm hover-item"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="@lang('site.userWithoutPlan')"
                                wire:click.prevent="userNullPlan"
                                >
                                <i class="fa fa-calendar text-primary"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-sm hover-item"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="@lang('site.exportExcel')"
                                wire:click.prevent="exportExcel">
                                <i class="fa fa-file-excel text-success"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-sm hover-item"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="@lang('site.exportPDF')"
                                wire:click.prevent="exportPDF">
                                <i class="fa fa-file-pdf text-danger"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-sm hover-item {{ $selectedRows ? '' : 'disabled' }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="@lang('site.eventsAcive')"
                                wire:click.prevent="setAllAsActive">
                                <i class="fa fa-regular fa-thumbs-up text-success"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-sm hover-item {{ $selectedRows ? '' : 'disabled' }}"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="@lang('site.eventsInAcive')"
                                wire:click.prevent="setAllAsInActive">
                                <i class="fa fa-solid fa-thumbs-down text-dark"></i>
                            </a>
                            <a href="#" class="btn bg-danger text-white btn-sm hover-item {{ $selectedRows ? '' : 'disabled' }} delete-confirm"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="@lang('site.deleteSelected')"
                                wire:click.prevent="deleteSelectedRows">
                                <i class="fa fa-duotone fa-trash"></i>
                            </a>
                        </div>

                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="form-group d-flex justify-content-between align-items-center">
                        {{-- search --}}
                        <div class="input-group" style="width: 200px;">
                            <input dir="rtl" type="search" wire:model.debounce.350ms="searchTerm"
                                class="form-control form-control-sm" placeholder="@lang('site.searchFor')..." value="">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                        @role('superadmin')
                        {{-- offices Filter --}}
                        <div>
                            <select dir="rtl" name="office_id" wire:model="byOffice"
                                class="form-control form-control-sm">
                                <option value="" selected>@lang('site.choise', ['name' => 'مكتب التعليم'])</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endrole
                        {{-- Week Filter --}}
                        <div>
                            <select dir="rtl" name="week_id" wire:model="byWeek"
                                class="form-control form-control-sm mr-5">
                                <option value="" selected>@lang('site.allWeeks')</option>
                                @foreach ($weeks as $week)
                                <option value="{{ $week->id }}" {{ $week->active ? 'selected' : '' }} style="{{
                                    $week->active ? 'color: blue; background:#F2F2F2;' : '' }}">{{ $week->title . ' ( ' .
                                    $week->semester->school_year . ' )' }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Status Filter --}}
                        <div class="custom-control custom-switch">
                            <input type="checkbox" wire:model="byStatus" class="custom-control-input"
                                id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">@lang('site.activeEvents')</label>
                        </div>
                        {{-- Total Events --}}
                        <div>
                            <label class="flex-wrap">@lang('site.totalEvents') : &nbsp( {{ $events->total() }} )</label>
                        </div>
                    </div>

                    @if ($selectedRows)
                    <span class="mb-2 text-success">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        selected
                        <span class="text-dark font-weight-bold">{{ count($selectedRows) }}</span> {{
                        Str::plural('event', count($selectedRows)) }}
                        <a class="ml-2 text-gray" href="" wire:click="resetSelectedRows" data-toggle="tooltip"
                            data-placement="top" title="Reset Selected Rows"><i class="fas fa-times"></i></a>
                    </span>
                    @endif

                    <div class="table-responsive">
                        <table id="example2" class="table text-center table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead class="bg-light ">
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" wire:model="selectPageRows" value=""
                                                class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>
                                        @lang('site.name')
                                        <span wire:click="sortBy('user_id')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'user_id' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'user_id' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        @lang('site.specialization')
                                        {{-- <span wire:click="sortBy('specialization')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'specialization' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'specialization' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span> --}}
                                    </th>
                                    <th>
                                        @lang('site.task')
                                        {{-- <span wire:click="sortBy('title')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span> --}}
                                    </th>
                                    <th>
                                        @lang('site.date')
                                        <span wire:click="sortBy('title')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    {{-- <th>
                                        days
                                    </th> --}}
                                    <th>
                                        @lang('site.schoolWeek')
                                        <span wire:click="sortBy('week_id')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'week_id' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'week_id' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        @lang('site.status')
                                        {{-- <span wire:click="sortBy('status')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'status' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'status' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span> --}}
                                    </th>
                                    {{-- <th>
                                        Created At
                                        <span wire:click="sortBy('created_at')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th> --}}
                                    <th colspan="2">@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($events as $event)
                                <tr>
                                    <td class="align-middle" scope="col">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" wire:model="selectedRows" value="{{ $event->id }}"
                                                class="custom-control-input" id="{{ $event->id }}">
                                            <label class="custom-control-label" for="{{ $event->id }}"></label>
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="dtr-control align-middle">{{ $event->user->name }}</td>
                                    <td class="align-middle">{{ $event->user->specialization->name }}</td>
                                    <td class="align-middle" style="color: {{ $event->color }};">{{ $event->title }}</td>
                                    <td class="align-middle">{{ Alkoumi\LaravelHijriDate\Hijri::Date('l', $event->start) }}<br>
                                        {{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $event->start) }}<br>
                                        {{ Carbon\Carbon::parse($event->start)->toDateString() }}
                                    </td>
                                    {{-- <td>{{
                                        (Carbon\Carbon::parse($event->end))->diffInDays(Carbon\Carbon::parse($event->start))
                                        }}</td> --}}
                                    <td class="align-middle">{{ $event->week->title . ' (' . $event->week->semester->school_year . ' )' }}
                                    </td>
                                    <td class="align-middle">
                                        <span
                                            class="font-weight-bold badge text-white {{ $event->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $event->status() }}
                                        </span>
                                    </td>
                                    {{-- <td>{{ Alkoumi\LaravelHijriDate\Hijri::Date('l', $event->created_at) }}<br>
                                        {{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $event->created_at) }}<br>
                                        {{ Carbon\Carbon::parse($event->created_at)->toDateString() }}
                                    </td> --}}
                                    <td class="align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <button wire:click.prevent="edit({{ $event }})"
                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                            <button wire:click.prevent="confirmEventRemoval({{ $event->id }})"
                                                class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash bg-danger"></i></button>
                                        </div>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="10" class="text-center">@lang('site.noDataFound')</td>
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

    <div class="modal fade" id="form" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateEvent' : 'createEvent' }}">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal)
                            <span>@lang('site.updateEvent')</span>
                            @else
                            <span>@lang('site.addEvent')</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="col-12">
                                <!-- Modal Office -->
                                @role('superadmin')
                                <div class="form-group">
                                    <label for="office_id">@lang('site.office')</label>
                                    <select id="office_id" class="form-control @error('office_id') is-invalid @enderror" wire:model.defer="data.office_id" wire:change="officeOption($event.target.value)">
                                        <option hidden>@lang('site.choise', ['name' => 'مكتب التعليم'])</option>
                                        @foreach ($offices as $office)
                                            <option class="bg-light" value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('office_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                @endrole

                                <!-- Modal user_id -->
                                <div class="form-group">
                                    <label for="user_id" class="form-label">{{ __('site.userName') }} :</label>

                                    <select name="user_id" wire:model.defer="data.user_id"
                                        class="form-control  @error('user_id') is-invalid @enderror" id="user_id">
                                        <option value="" selected>@lang('site.choise', ['name' => 'المشرف التربوي'])</option>
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

                                <!-- Modal Semester -->
                                <div class="form-group">
                                    <label for="semester_id" class="form-label">{{ __('site.semester') }} :</label>

                                    <select name="semester_id" wire:model.defer="data.semester_id"
                                        class="form-control  @error('semester_id') is-invalid @enderror" id="semester_id">
                                        <option value="">@lang('site.choise', ['name' => 'الفصل الدراسي'])</option>
                                        @foreach ($semesters as $semester)
                                        <option value="{{ $semester->id }}"
                                            style="{{ $semester->active ? 'color: blue; background:#F2F2F2;' : '' }}">{{ $semester->title . ' ( ' .
                                            $semester->school_year . ' )' }}</option>
                                        @endforeach
                                    </select>

                                    @error('semester_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <!-- Modal School Week -->
                                <div class="form-group">
                                    <label for="week_id" class="form-label">{{ __('site.schoolWeek') }} :</label>

                                    <select name="week_id" wire:model.defer="data.week_id"
                                        class="form-control  @error('week_id') is-invalid @enderror" id="week_id">
                                        <option value="">@lang('site.choise', ['name' => 'الأسبوع الدراسي'])</option>
                                        @foreach ($weeks as $week)
                                        <option value="{{ $week->id }}"
                                            style="{{ $week->active ? 'color: blue; background:#F2F2F2;' : '' }}">{{ $week->title . ' ( ' .
                                            $week->semester->school_year . ' )' }}</option>
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
                                    <label for="title" class="col-form-label">@lang('site.task') :</label>

                                    <select name="title" wire:model.defer="data.title"
                                        class="form-control  @error('title') is-invalid @enderror" id="title">
                                        <option value="" selected>@lang('site.choise', ['name' => 'المهمة'])</option>
                                        @foreach ($tasks as $task)
                                        <option value="{{ $task->name }}">{{ $task->name }}</option>
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
                                    <label for="start">@lang('site.date') :</label>
                                    <input type="date" wire:model.defer="data.start"
                                        class="form-control @error('start') is-invalid @enderror" id="start"
                                        aria-describedby="startHelp" placeholder="Enter start">
                                    @error('start')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal Event End -->
                                {{-- <div class="form-group">
                                    <label for="end">End</label>
                                    <input type="hidden" wire:model.defer="data.end"
                                        class="form-control @error('end') is-invalid @enderror" id="end"
                                        aria-describedby="endHelp" placeholder="Enter end">
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
                            <label for="statusRadio" class="d-inline">@lang('site.status') :</label>
                            <div class="icheck-primary d-inline ml-2 mr-2">
                                <input type="radio" id="radioPrimary1" wire:model="data.status" value="1">
                                <label for="radioPrimary1">@lang('site.active')</label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2" wire:model="data.status" value="0">
                                <label for="radioPrimary2">@lang('site.inActive')</label>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="mr-1 fa fa-times"></i> @lang('site.cancel')</button>
                        <button type="submit" class="btn btn-primary"><i class="mr-1 fa fa-save"></i>
                            @if ($showEditModal)
                                <span>@lang('site.saveChanges')</span>
                            @else
                                <span>@lang('site.save')</span>
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Delete Event -->

    <div dir="rtl" class="modal fade" id="confirmationModal" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5>@lang('site.deleteEvent')</h5>
                </div>

                <div class="modal-body">
                    <h4>@lang('site.deleteMessage') ?</h4>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="mr-1 fa fa-times"></i> @lang('site.cancel')</button>
                    <button type="button" wire:click.prevent="deleteEvent" class="btn btn-danger"><i
                            class="mr-1 fa fa-trash"></i>@lang('site.delete')</button>
                </div>
            </div>
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
                    title: '?@lang("site.delete")',
                    text: "@lang('site.deleteMessage')",
                    icon: 'warning',
                    iconHtml: '؟',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emit('deleteConfirmed')
                    }
                })
            })
    </script>

    @endsection

</div>
