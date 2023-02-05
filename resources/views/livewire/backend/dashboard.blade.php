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
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="shadow rounded p-4 border" style="height: 28rem;">

                                    <div id="highchart"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </section>

                {{-- <section class="col-lg-12 connectedSortable">
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
                            </div>
                        </div>
                        <div class="card-body" dir="rtl">
                            <div class="table-responsive">
                                <div class="shadow rounded p-4 border">
                                    <div class="table-responsive">
                                        <table id="example2"  class="table text-center table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>@lang('site.name')</th>
                                                    <th>@lang('site.count')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($chartData as $key => $value)
                                                    <tr>
                                                        <td class="bg-light">{{ $loop->iteration }}</td>
                                                        <td>{{ $key }}</td>
                                                        <td>{{ $value }}</td>
                                                    </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">@lang('site.noDataFound')</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}

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
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" dir="rtl">
                                <div class="shadow rounded p-4 border">
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
                                                    <td colspan="10" class="text-center">@lang('site.noDataFound')</td>
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
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            $(function(){

                const data = <?php echo json_encode($chartData); ?>;

                const title=[];
                const count=[];

                for (const [key, value] of Object.entries(data)) {
                    title.push(key);
                    count.push(value);
                }

                $("#highchart").highcharts({
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'المهام المنفذة خلال الفصل الدراسي'
                    },
                    // subtitle: {
                    //     text: 'Source: WorldClimate.com'
                    // },
                    xAxis: {
                        categories:  title,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'عدد المهام'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y: 1f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'زيارات المشرفين',
                        data: count

                    }]
                });
            });
        </script>
    @endsection
</div>

