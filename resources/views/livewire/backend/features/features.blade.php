<div>
    @section('style')
    <style>
        .disabled-link {
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
                    <h1 class="m-0">@lang('site.features')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('site.dashboard')</a>
                        </li>
                        <li class="breadcrumb-item active">@lang('site.features')</li>
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
                        <button wire:click.prevent='addNewFeature' class="ml-1 btn btn-sm btn-primary">
                            <i class="mr-2 fa fa-plus-circle" aria-hidden="true">
                                <span>@lang('site.addRecord', ['name' => 'ميزة / خاصية'])</span>
                            </i>
                        </button>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm">@lang('site.action')</button>
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                {{-- <a class="dropdown-item" wire:click.prevent="exportExcel" href="#"
                                    aria-disabled="true">Export to Excel</a> --}}
                                {{-- <a class="dropdown-item" wire:click.prevent="exportPDF" href="#">Export to PDF</a>
                                --}}
                                {{-- <div class="dropdown-divider"></div> --}}
                                {{-- @if ($selectedRows) --}}
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}"
                                    wire:click.prevent="setAllAsActive" href="#">@lang('site.setActive')</a>
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}"
                                    wire:click.prevent="setAllAsInActive" href="#">@lang('site.setInActive')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ $selectedRows ? 'text-danger' : 'disabled-link' }}  delete-confirm"
                                    wire:click.prevent="deleteSelectedRows" href="#">@lang('site.deleteSelected')</a>
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
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-group ">
                            {{-- search --}}
                            <div class="input-group" style="width: 200px;">
                                <input dir="rtl" type="search" wire:model="searchTerm" class="form-control"
                                    placeholder="@lang('site.searchFor')..." value="">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <label class="flex-wrap">@lang('site.totalRecord', ['name' => 'الخصائص والمميزات']) : &nbsp{{
                            $features->total() }}</label>

                    </div>

                    @if ($selectedRows)
                    <span class="mb-2 text-success">
                        <i class="fa fa-level" aria-hidden="true"></i>
                        selected
                        <span class="text-dark font-weight-bold">{{ count($selectedRows) }}</span> {{
                        Str::plural('feature', count($selectedRows)) }}
                        <a class="ml-2 text-gray" href="" wire:click="resetSelectedRows" data-toggle="tooltip"
                            data-placement="top" title="Reset Selected Rows"><i class="fas fa-times"></i></a>
                    </span>
                    @endif

                    <div class="table-responsive">
                        <table id="example2" class="table text-center table-bordered table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead class="bg-light">
                                <tr>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" wire:model="selectPageRows" value=""
                                                class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th> @lang('site.title')</th>
                                    <th>@lang('site.value')</th>
                                    <th>@lang('site.section')</th>
                                    <th>@lang('site.office')</th>
                                    <th> @lang('site.status') </th>
                                    <th colspan="2">@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($features as $feature)
                                <tr>
                                    <td scope="col">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" wire:model="selectedRows" value="{{ $feature->id }}"
                                                class="custom-control-input" id="{{ $feature->id }}">
                                            <label class="custom-control-label" for="{{ $feature->id }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $feature->title }}</td>
                                    <td>
                                        <span
                                            class="font-weight-bold badge text-white {{ $feature->value == 1 ? 'bg-secondary' : 'bg-success' }}">
                                            {{ $feature->value() }}
                                        </span>
                                    </td>
                                    <td dir="rtl">{{ $feature->section }}</td>
                                    <td>{{ $feature->office->name }}</td>
                                    <td>
                                        <span
                                            class="font-weight-bold badge text-white {{ $feature->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $feature->status() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <button wire:click.prevent="edit({{ $feature }})"
                                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                            @if (auth()->user()->roles[0]->name == 'superadmin')
                                            <button wire:click.prevent="confirmFeatureRemoval({{ $feature->id }})"
                                                class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash bg-danger"></i></button>
                                            @else
                                            <button class="btn btn-danger btn-sm" disabled><i
                                                    class="fa fa-trash bg-danger"></i></button>
                                            @endif
                                        </div>
                                        {{-- <form action="" method="post" id="delete-site-{{ $site->id }}"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">@lang('site.noDataFound')</td>
                                </tr>
                                @endforelse
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="5">
                                        {!! $sites->appends(request()->all())->links() !!}
                                    </td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-light">
                    {!! $features->appends(request()->all())->links() !!}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal Create or Update Site -->

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateFeature' : 'createFeature' }}">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal)
                            <span>@lang('site.updateRecord', ['name' => 'ميزة / خاصية'])</span>
                            @else
                            <span>@lang('site.addRecord', ['name' => 'ميزة / خاصية'])</span>
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
                                <div class="form-group">
                                    <label class="float-right" for="office_id">@lang('site.office')</label>
                                    <select id="office_id" class="form-control @error('office_id') is-invalid @enderror"
                                        wire:model.defer="data.office_id">
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

                                <!-- Modal feature title -->
                                <div dir="rtl" class="form-group">
                                    <label class="float-right">@lang('site.featureTitle')</label>
                                    <input type="text" wire:model.defer="data.title"
                                        class="form-control @error('title') is-invalid @enderror" id="title"
                                        aria-describedby="titleHelp"
                                        placeholder="@lang('site.enterFieldName', ['name' => 'عنوان الميزة / الخاصية'])">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal feature section -->
                                <div dir="rtl" class="form-group">
                                    <label class="float-right">@lang('site.featureSection')</label>
                                    <input type="text" wire:model.defer="data.section"
                                        class="form-control @error('section') is-invalid @enderror" id="section"
                                        aria-describedby="sectionHelp"
                                        placeholder="@lang('site.enterFieldName', ['name' => 'اسم القسم'])">
                                    @error('section')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal Description -->
                                <div class="form-group">
                                    <label class="float-right">@lang('site.featureDescription')</label>
                                    <textarea dir="rtl" wire:model.defer="data.description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="اكتب نص لا يزيد عن 255 حرف" spellcheck="false" data-ms-editor="true"></textarea>

                                    @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal feature Value -->
                                <div class="form-group clearfix">
                                    <label for="statusRadio" class="d-inline">@lang('site.value') :</label>
                                    <div class="icheck-primary d-inline ml-2 mr-2">
                                        <input type="radio" id="radioPrimary1value" wire:model="data.value" value="0">
                                        <label for="radioPrimary1value">@lang('site.open')</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2value" wire:model="data.value" value="1">
                                        <label for="radioPrimary2value">@lang('site.close')</label>
                                    </div>
                                </div>
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

    <!-- Modal Delete Site -->

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5>@lang('site.deleteRecord', ['name' => 'ميزة / خاصية'])</h5>
                </div>

                <div class="modal-body">
                    <h4>@lang('site.deleteMessage')</h4>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                            class="mr-1 fa fa-times"></i> @lang('site.cancel')</button>
                    <button type="button" wire:click.prevent="deleteFeature" class="btn btn-danger"><i
                            class="mr-1 fa fa-trash"></i>@lang('site.delete')</button>
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
