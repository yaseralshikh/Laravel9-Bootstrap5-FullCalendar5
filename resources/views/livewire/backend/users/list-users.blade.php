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
                    <h1 class="m-0">@lang('site.users')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('site.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('site.users')</li>
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
                        <button wire:click.prevent='addNewUser' class="ml-1 btn btn-sm btn-primary">
                            <i class="mr-2 fa fa-plus-circle"
                                aria-hidden="true">
                                <span>@lang('site.addUser')</span>
                            </i>
                        </button>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm">@lang('site.action')</button>
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" dir="rtl">
                                @role('superadmin')
                                    <a class="dropdown-item" wire:click.prevent="importExcelForm" href="#">@lang('site.importExcel')</a>
                                @endrole
                                <a class="dropdown-item" wire:click.prevent="exportExcel" href="#" aria-disabled="true">@lang('site.exportExcel')</a>
                                <a class="dropdown-item" wire:click.prevent="exportPDF" href="#">@lang('site.exportPDF')</a>
                                <div class="dropdown-divider"></div>
                                {{-- @if ($selectedRows) --}}
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}" wire:click.prevent="setAllAsActive" href="#">@lang('site.active')</a>
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}" wire:click.prevent="setAllAsInActive" href="#">@lang('site.inActive')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ $selectedRows ? 'text-danger' : 'disabled-link' }}  delete-confirm" wire:click.prevent="deleteSelectedRows" href="#">@lang('site.deleteSelected')</a>
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
                            <input type="search" wire:model="searchTerm" class="form-control" placeholder="@lang('site.searchFor')" value="Lorem ipsum">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                        @role('superadmin')
                        {{-- Week Filter --}}
                        <div>
                            <select dir="rtl" name="office_id" wire:model="byOffice"
                                class="form-control form-control-sm">
                                <option value="" selected>@lang('site.choise')</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endrole

                        <div>
                            <label class="flex-wrap">@lang('site.totalUsers') : &nbsp{{ $users->total() }}</label>
                        </div>

                    </div>

                    @if ($selectedRows)
                        <span class="mb-2 text-success">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            @lang('site.selected')
                            <span class="text-dark font-weight-bold">{{ count($selectedRows) }}</span> {{ Str::plural('user', count($selectedRows)) }}
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
                                        @lang('site.name')
                                        <span wire:click="sortBy('name')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'name' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'name' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th>@lang('site.specialization')</th>
                                    <th>@lang('site.role')</th>
                                    <th>
                                        @lang('site.status')
                                        <span wire:click="sortBy('status')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'status' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'status' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th colspan="2">@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td scope="col">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" wire:model="selectedRows" value="{{ $user->id }}" class="custom-control-input" id="{{ $user->id }}">
                                                <label class="custom-control-label" for="{{ $user->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $user->name }}</td>
                                        <td>{{ $user->specialization->name }}</td>
                                        {{-- <td>{{ $user->email }}</td> --}}
                                        <td>{{ $user->roles[0]->name }}</td>
                                        <td>
                                            <span  class="font-weight-bold badge text-white {{ $user->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $user->status() }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button wire:click.prevent="edit({{ $user }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                                <button wire:click.prevent="show({{ $user }})" class="btn btn-info btn-sm"><i class="fa fa-user"></i></button>
                                                @if ($user->roles[0]->name == 'user')
                                                    <button wire:click.prevent="confirmUserRemoval({{ $user->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash bg-danger"></i></button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash bg-danger"></i></button>
                                                @endif
                                            </div>
                                            {{-- <form action="" method="post" id="delete-user-{{ $user->id }}" class="d-none">
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
                                        {!! $users->appends(request()->all())->links() !!}
                                    </td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-light">
                    {!! $users->appends(request()->all())->links() !!}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal Create or Update User -->

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal)
                                <span>@lang('site.updateUser')</span>
                            @else
                            <span>@lang('site.addUser')</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- @if ($errors->hasAny(['image', 'image.*']))
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="col-12">

                                <!-- Modal User Full Name -->

                                <div class="form-group">
                                    <label for="name">@lang('site.fullName')</label>
                                    <input type="text" wire:model.defer="data.name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="@lang('site.enterFullName')">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Email -->

                                <div class="form-group">
                                    <label for="email">@lang('site.email')</label>
                                    <input type="email" wire:model.defer="data.email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="@lang('site.enterEmail')">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Office -->
                                @role('superadmin')
                                <div class="form-group">
                                    <label for="office_id">@lang('site.office')</label>
                                    <select id="office_id" class="form-control @error('office_id') is-invalid @enderror" wire:model.defer="data.office_id">
                                        <option hidden>@lang('site.choise')</option>
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

                                <!-- Modal User Specialization -->

                                <div class="form-group">
                                    <label for="specialization_id">@lang('site.specialization')</label>
                                    <select id="specialization_id" class="form-control @error('specialization_id') is-invalid @enderror" wire:model.defer="data.specialization_id">
                                        <option hidden>@lang('site.choise')</option>
                                        @foreach ($specializations as $specialization)
                                            <option class="bg-light" value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('specialization_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Type -->

                                <div class="form-group">
                                    <label for="type">@lang('site.type')</label>
                                    <select id="type" class="form-control @error('type') is-invalid @enderror" wire:model.defer="data.type">
                                        <option hidden>@lang('site.choise')</option>
                                        @foreach ($types as $type)
                                            <option class="bg-light" value="{{ $type['title'] }}">{{ $type['title'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Modal User Password -->

                                <div class="form-group">
                                    <label for="password">@lang('site.password')</label>
                                    <input type="password" wire:model.defer="data.password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="@lang('site.enterPassword')">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <!-- Modal User Password Confirmation -->

                                <div class="form-group">
                                    <label for="passwordConfirmation">@lang('site.passwordConfirmation')</label>
                                    <input type="password" wire:model.defer="data.password_confirmation" class="form-control" id="passwordConfirmation" placeholder="@lang('site.enterConfirmPassword')">
                                </div>
                            </div>
                        </div>

                        <!-- Modal User Status -->
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> @lang('site.cancel')</button>
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

    <!-- Modal Show User -->

    <div class="modal fade" id="modal-show-user">
        <div class="modal-dialog">
          <div class="modal-content bg-dark">
            <div class="modal-body text-muted">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img src="{{ asset('backend/img/sweeklyplan.png') }}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        </div>

                        <h3 class="text-center profile-username">{{ $data['name'] ?? ''  }}</h3>

                        <ul class="mb-3 list-group list-group-unbordered" dir="rtl">
                            <li class="list-group-item">
                                <b class="float-right">@lang('site.office') : </b> <a>{{ $data['office'] ?? ''  }}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="float-right">@lang('site.specialization') : </b> <a>{{ $data['specialization'] ?? ''  }}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="float-right">@lang('site.type') : </b> <a>{{ $data['type'] ?? ''  }}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="float-right">@lang('site.email') :</b> <a>{{ $data['email'] ?? ''  }}</a>
                            </li>
                            <li class="list-group-item">
                                <b class="float-right">@lang('site.memberSince') :</b> <a>{{ \Carbon\Carbon::parse($data['created_at'] ?? '')->diff(\Carbon\Carbon::now())->format('%y سنه, %m شهر و %d يوم') }}</a>
                            </li>
                        </ul>

                        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">@lang('site.close')</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
    </div>

    <!-- Modal Delete User -->

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5>@lang('site.delete')</h5>
                </div>

                <div class="modal-body">
                    <h4>@lang('site.deleteMessage')</h4>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> @lang('site.cancel')</button>
                    <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="mr-1 fa fa-trash"></i>@lang('site.delete')</button>
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
                        <h5 class="modal-title" id="exampleModalLabel" dir="rtl">
                            @lang('site.importExcel')
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <!-- Excel File -->

                        <div class="form-group">
                            <label for="custom-file">@lang('site.chooseFile')
                            </label>
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
                                        @lang('site.browse')
                                    @endif
                                </label>
                            </div>

                            <!-- import Options Radios Button -->

                            <div class="mb-0 form-group">
                                <label for="importRadio" class="d-inline">@lang('site.importAs')</label>

                                <div class="icheck-primary d-inline ml-2 mr-2">
                                    <input type="radio" wire:click="importType('addNew')" name="optionsRadiosInline" id="optionsRadiosInline1" value="addNew" checked="checked">
                                    <label for="optionsRadiosInline1">@lang('site.new')</label>
                                </div>

                                <div class="icheck-primary d-inline">
                                    <input type="radio" wire:click="importType('Update')" name="optionsRadiosInline" id="optionsRadiosInline2" value="Update">
                                    <label for="optionsRadiosInline2">@lang('site.update')</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> @lang('site.cancel')</button>
                        <button type="submit" class="btn btn-primary"><i class="mr-1 fa fa-open"></i> @lang('site.import')</button>
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
                    $('#modal-show-user').modal('hide');
                });

                window.addEventListener('show-modal-show', function (event) {
                    $('#modal-show-user').modal('show');
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
