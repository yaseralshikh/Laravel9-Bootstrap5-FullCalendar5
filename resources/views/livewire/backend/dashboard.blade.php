<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@lang('site.dashboard')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('site.home')</a></li> --}}
                        <li class="breadcrumb-item active">@lang('site.dashboard')</li>
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
            <div class="row">
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $schoolsCount }}</h3>

                            <p>@lang('site.schools')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-university"></i>
                        </div>
                        <a href="{{ route('admin.tasks') }}" class="small-box-footer">@lang('site.moreInfo') <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $usersCount }}</h3>

                            <p>@lang('site.users')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('admin.users') }}" class="small-box-footer">@lang('site.moreInfo') <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box" style="background-color:rgba(38, 248, 255, 0.784);">
                        <div class="inner">
                            <div class="d-sm-inline-flex">
                                <h3>{{ $eventsCount }}</h3>
                                {{-- <div class="form-group pt-1 pl-4">
                                    <select wire:change="getEventsCount($event.target.value)" id="semesterID" class="form-control form-control-sm">
                                        @foreach ($semesters as $semester)
                                            <option value="{{ $semester->id }}" {{ $semester->active ? 'selected' : '' }}>{{ $semester->title . ' ' . $semester->school_year }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>
                            <p>@lang('site.events')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('admin.events') }}" class="small-box-footer text-dark">@lang('site.moreInfo') <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $weeksCount }}</h3>

                            <p>@lang('site.weeks')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-calendar"></i>
                        </div>
                        <a href="{{ route('admin.weeks') }}" class="small-box-footer">@lang('site.moreInfo') <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $eventsSchoolCount }}</h3>

                            <p>@lang('site.eventsSchool')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-model-s"></i>
                        </div>
                        <span class="small-box-footer"></span>
                        {{-- <a href="{{ route('admin.users') }}" class="small-box-footer">@lang('site.moreInfo') <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box text-white bg-secondary">
                        <div class="inner">
                            <h3>{{ $eventsOfficeCount }}</h3>

                            <p>@lang('site.eventsOffice')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-home"></i>
                        </div>
                        <span class="small-box-footer"></span>
                        {{-- <a href="{{ route('admin.users') }}" class="small-box-footer">@lang('site.moreInfo') <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box" style="background-color:rgb(239, 117, 47);">
                        <div class="inner">
                            <h3>{{ $eventsTrainingCount }}</h3>

                            <p>@lang('site.eventsTraining')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <span class="small-box-footer"></span>
                        {{-- <a href="{{ route('admin.users') }}" class="small-box-footer">@lang('site.moreInfo') <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-3">
                    <!-- small box -->
                    <div class="small-box" style="background-color:rgba(124, 47, 239, 0.3);">
                        <div class="inner">
                            <h3>{{ $eventsVacationCount }}</h3>

                            <p>@lang('site.eventsVacation')</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-plane"></i>
                        </div>
                        <span class="small-box-footer"></span>
                        {{-- <a href="{{ route('admin.users') }}" class="small-box-footer">@lang('site.moreInfo') <i class="fas fa-arrow-circle-right"></i></a> --}}
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                @lang('site.barChart')
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="shadow rounded p-4 border" style="height: 32rem;">
                                    <livewire:livewire-column-chart
                                        key="{{ $columnChartModel->reactiveKey() }}"
                                        :column-chart-model="$columnChartModel"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>

                <!-- users Events plan -->

                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                @lang('site.statisticsUsersEvent')
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" dir="rtl">
                                <div class="shadow rounded p-4 border" style="height: 32rem;">
                                    <div class="table-responsive">
                                        <table id="example2"  class="table text-center table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('site.name')</th>
                                                    <th>@lang('site.specialization')</th>
                                                    <th>@lang('site.type')</th>
                                                    <th>@lang('site.eventsSchool')</th>
                                                    <th>@lang('site.eventsOffice')</th>
                                                    <th>@lang('site.eventsTraining')</th>
                                                    <th>@lang('site.eventsVacation')</th>
                                                    <th>@lang('site.eventsTotal')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($users as $user)
                                                    <tr>
                                                        <td class="bg-light">{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->specialization->name }}</td>
                                                        <td>{{ $user->type }}</td>
                                                        <td>{{ $user->events->whereNotIn('title',['يوم مكتبي','برنامج تدريبي','إجازة'])->count() }}</td>
                                                        <td>{{ $user->events->where('title', 'يوم مكتبي')->count() }}</td>
                                                        <td>{{ $user->events->where('title', 'برنامج تدريبي')->count() }}</td>
                                                        <td>{{ $user->events->where('title', 'إجازة')->count() }}</td>
                                                        <td class="bg-light">{{ $user->events->count() }}</td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">No Users found</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    @section('script')
        <!-- jQuery UI 1.11.4 -->
        <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button)
        </script>
        <!-- ChartJS -->
        <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ asset('backend/plugins/sparklines/sparkline.js') }}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ asset('backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- daterangepicker -->
        <script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
        <script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
        <!-- Tempusdominus Bootstrap 4 -->
        <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
        <!-- Summernote -->
        <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <!-- overlayScrollbars -->
        <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
        <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

    @endsection
</div>

