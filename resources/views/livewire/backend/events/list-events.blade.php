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

        .hover-item:hover {
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
                                <span>@lang('site.addRecord', ['name' => 'خطة'])</span>
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
                                <a class="dropdown-item" wire:click.prevent="taskNullPlan"
                                    href="#">@lang('site.taskWithoutPlan')</a>
                                <div class="dropdown-divider"></div>
                                <a dir="rtl" class="dropdown-item" wire:click.prevent="exportExcel" href="#"
                                    aria-disabled="true">@lang('site.exportExcel')</a>
                                {{-- <a class="dropdown-item" wire:click.prevent="importExcelForm" href="#">Import from
                                    Excel</a> --}}
                                <a dir="rtl" class="dropdown-item" wire:click.prevent="exportPDF"
                                    href="#">@lang('site.exportPDF')</a>
                                <a dir="rtl" class="dropdown-item" target="_blank" href="https://www.ilovepdf.com/merge_pdf"
                                    aria-disabled="true">@lang('site.merge_pdf')</a>
                                <div class="dropdown-divider"></div>
                                {{-- @if ($selectedRows) --}}
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}"
                                    wire:click.prevent="setAllAsActive" href="#">@lang('site.eventsActive')</a>
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}"
                                    wire:click.prevent="setAllAsInActive" href="#">@lang('site.eventsInActive')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ $selectedRows ? 'text-danger' : 'disabled-link' }}  delete-confirm"
                                    wire:click.prevent="deleteSelectedRows" href="#">@lang('site.deleteSelected')</a>
                                {{-- @endif --}}
                            </div>
                        </div>
                    </h3>

                    <div class="card-tools">
                        <div class="btn-group pr-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" wire:model="featureValue" wire:change='updateFeatureValue' class="custom-control-input"
                                    id="customSwitchFeatureValue">
                                <label class="custom-control-label" for="customSwitchFeatureValue">@lang('site.featureValue')</label>
                            </div>
                            {{-- <a href="#" class="btn btn-outline-secondary btn-sm hover-item" data-toggle="tooltip"
                                data-placement="top" title="@lang('site.exportExcel')" wire:click.prevent="exportExcel">
                                <i class="fa fa-file-excel text-success"></i>
                            </a>
                            <a href="#" class="btn btn-outline-secondary btn-sm hover-item" data-toggle="tooltip"
                                data-placement="top" title="@lang('site.exportPDF')" wire:click.prevent="exportPDF">
                                <i class="fa fa-file-pdf text-danger"></i>
                            </a>
                            <a href="#"
                                class="btn btn-outline-secondary btn-sm hover-item {{ $selectedRows ? '' : 'disabled' }}"
                                data-toggle="tooltip" data-placement="top" title="@lang('site.eventsAcive')"
                                wire:click.prevent="setAllAsActive">
                                <i class="fa fa-regular fa-thumbs-up text-success"></i>
                            </a>
                            <a href="#"
                                class="btn btn-outline-secondary btn-sm hover-item {{ $selectedRows ? '' : 'disabled' }}"
                                data-toggle="tooltip" data-placement="top" title="@lang('site.eventsInAcive')"
                                wire:click.prevent="setAllAsInActive">
                                <i class="fa fa-solid fa-thumbs-down text-dark"></i>
                            </a>
                            <a href="#"
                                class="btn bg-danger text-white btn-sm hover-item {{ $selectedRows ? '' : 'disabled' }} delete-confirm"
                                data-toggle="tooltip" data-placement="top" title="@lang('site.deleteSelected')"
                                wire:click.prevent="deleteSelectedRows">
                                <i class="fa fa-duotone fa-trash"></i>
                            </a> --}}
                        </div>

                        {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button> --}}
                    </div>
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

                        {{-- Paginate Filter --}}
                        <div>
                            <select dir="rtl" wire:model="paginateValue" class="form-control">
                                <option value="50" selected>50</option>
                                <option value="100" selected>100</option>
                                <option value="150" selected>150</option>
                                <option value="100000" selected>@lang('site.all')</option>
                            </select>
                        </div>

                        {{-- Week Filter --}}
                        <div>
                            <select dir="rtl" name="week_id" wire:model="byWeek"
                                class="form-control form-control-sm mr-5">
                                <option value="" selected>@lang('site.choise', [ 'name' => 'الأسبوع الدراسي'])</option>
                                @foreach ($weeks as $week)
                                <option value="{{ $week->id }}" {{ $week->active ? 'selected' : '' }} style="{{
                                    $week->active ? 'color: blue; background:#F2F2F2;' : '' }}">{{ $week->title . ' ( '
                                    .
                                    $week->semester->school_year . ' )' }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Education type Filter --}}
                        <div>
                            <select dir="rtl" name="edu_type" wire:model="byEduType" class="form-control form-control-sm mr-5">
                                <option value="" selected>@lang('site.choise', [ 'name' => 'المرجع الإداري'])</option>
                                @foreach ($educationTypes as $eduType)
                                    <option class="bg-light" value="{{ $eduType['title'] }}">{{ $eduType['title'] }}</option>
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
                            <label class="flex-wrap">@lang('site.totalRecord', ['name' => 'الخطط']) : &nbsp( {{ $events->total() }} )</label>
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
                                                style="color:{{ $sortColumnName === 'user_id.' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'user_id' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        @lang('site.specialization')
                                    </th>
                                    <th>
                                        @lang('site.eduType')
                                    </th>
                                    <th>
                                        @lang('site.task')
                                        <span wire:click="sortBy('task_id')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'task_id' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'task_id' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        @lang('site.date')
                                        <span wire:click="sortBy('start')" class="text-sm float-sm-right"
                                            style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up"
                                                style="color:{{ $sortColumnName === 'start' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down"
                                                style="color : {{ $sortColumnName === 'start' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>
                                        @lang('site.schoolWeek')
                                    </th>
                                    <th>
                                        @lang('site.status')
                                    </th>
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
                                    <td class="align-middle">{{ $event->user->edu_type }}</td>
                                    <td class="align-middle" style="color: {{ $event->color }};">{{ $event->task->name }}
                                    </td>
                                    <td class="align-middle">{{ Alkoumi\LaravelHijriDate\Hijri::Date('l', $event->start)
                                        }}<br>
                                        {{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $event->start) }}<br>
                                        {{ Carbon\Carbon::parse($event->start)->toDateString() }}
                                    </td>
                                    {{-- <td>{{
                                        (Carbon\Carbon::parse($event->end))->diffInDays(Carbon\Carbon::parse($event->start))
                                        }}</td> --}}
                                    <td class="align-middle">{{ $event->week->title . ' (' .
                                        $event->week->semester->school_year . ' )' }}
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
                            <span>@lang('site.updateRecord', ['name' => 'خطة'])</span>
                            @else
                            <span>@lang('site.addRecord', ['name' => 'خطة'])</span>
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
                                {{-- @role('superadmin')
                                <div class="form-group">
                                    <label for="office_id">@lang('site.office')</label>
                                    <select id="office_id" class="form-control @error('office_id') is-invalid @enderror"
                                        wire:model.defer="data.office_id"
                                        wire:change="officeOption($event.target.value)"
                                        >
                                        <option value="" selected>@lang('site.choise', ['name' => 'مكتب التعليم'])</option>
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
                                @endrole --}}

                                <!-- Modal user_id -->
                                <div class="form-group" wire:ignore.self>
                                    <label for="user_id" class="form-label">{{ __('site.userName') }} :</label>

                                    <select name="user_id" wire:model.defer="data.user_id"
                                        class="form-control @error('user_id') is-invalid @enderror" id="user_id">
                                        <option value="" selected>@lang('site.choise', ['name' => 'المشرف التربوي'])
                                        </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('user_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <!-- Modal Levels -->
                                <div class="form-group mb-3" wire:ignore.self>
                                    <label for="level_id" class="col-form-label">@lang('site.level') :</label>
                                    <select wire:model.defer="level_id" wire:change="LevelOption($event.target.value)" id="level_id"
                                        class="form-control @error('level_id') is-invalid @enderror">
                                        <option value="" selected>@lang('site.choise', ['name' => 'المرحلة']) :</option>
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('level_id')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal Task (Event Title) -->

                                <div class="form-group" wire:ignore.self>
                                    <label for="task_id" class="col-form-label">@lang('site.task') :</label>
                                    <select wire:model.defer="data.task_id" id="task_id"
                                        class="form-control select2bs4 @error('task_id') is-invalid @enderror" id="task_id">
                                        <option value="" selected>@lang('site.choise', ['name' => 'المهمة'])</option>
                                        @foreach ($tasks as $task)
                                            <option value="{{ $task->id }}"
                                                {{-- style="
                                                {{ $task->level_id == 1 ? 'background:#FBEFF2;' : '' }}
                                                {{ $task->level_id == 2 ? 'background:#E6F8E0;' : '' }}
                                                {{ $task->level_id == 3 ? 'background:#F7F8E0;' : '' }}
                                                {{ $task->level_id == 4 ? 'background:#F8ECE0;' : '' }}
                                                {{ $task->level_id == 5 ? 'background:#E0F2F7;' : '' }}
                                                {{ $task->level_id == 7 ? 'background:#F5F5F5;' : '' }}" --}}
                                                >
                                                {{ $task->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('task_id')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>

                                <!-- Modal Event Start -->

                                <div class="form-group" wire:ignore.self>
                                    <label for="start">@lang('site.date') :</label>
                                    <input type="date" wire:model.defer="data.start"
                                        class="form-control @error('start') is-invalid @enderror" id="start"
                                        aria-describedby="startHelp" placeholder="Enter start">

                                    @error('start')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
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
                    <h5>@lang('site.deleteRecord', ['name' => 'خطة'])</h5>
                </div>

                <div class="modal-body">
                    <h4>@lang('site.deleteMessage')</h4>
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
        $(document).ready(function() {

                window.addEventListener('hide-form', function (event) {
                    $('#form').modal('hide');
                });

                window.addEventListener('show-form', function (event) {

                    $('#form').modal('show');

                    Livewire.hook('message.processed', (message, component) => {

                        $('.select2bs4').select2({
                            theme: 'bootstrap4',
                            dropdownParent: $('#form')
                        });

                        $('.select2bs4').on("select2:select", function (e) {
                            var selectedValue = $(e.currentTarget).val();
                            @this.set('data.task_id', selectedValue)
                        });

                    })

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
