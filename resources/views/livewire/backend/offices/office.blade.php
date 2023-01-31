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
                    <h1 class="m-0">@lang('site.offices')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">@lang('site.dashboard')</a></li>
                        <li class="breadcrumb-item active">@lang('site.offices')</li>
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
                        <button wire:click.prevent='addNewOffice' class="ml-1 btn btn-sm btn-primary">
                            <i class="mr-2 fa fa-plus-circle"
                                aria-hidden="true">
                                <span>@lang('site.addRecord', ['name' => 'مكتب / ادارة'])</span>
                            </i>
                        </button>

                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm">@lang('site.action')</button>
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                {{-- @if ($selectedRows) --}}
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}" wire:click.prevent="setAllAsActive" href="#">@lang('site.setActive')</a>
                                <a class="dropdown-item {{ $selectedRows ? '' : 'disabled-link' }}" wire:click.prevent="setAllAsInActive" href="#">@lang('site.setInActive')</a>
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
                            <input dir="rtl" type="search" wire:model="searchTerm" class="form-control" placeholder="@lang('site.searchFor')..." value="">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Status Filter --}}
                        {{-- <div class="custom-control custom-switch">
                            <input type="checkbox" wire:model="byStatus" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">InActive Offices</label>
                        </div> --}}

                        <label class="flex-wrap">@lang('site.totalRecord', ['name' => 'المكاتب / الإدارات']) : &nbsp{{ $offices->total() }}</label>

                    </div>

                    @if ($selectedRows)
                        <span class="mb-2 text-success">
                            <i class="fa fa-level" aria-hidden="true"></i>
                            selected
                            <span class="text-dark font-weight-bold">{{ count($selectedRows) }}</span> {{ Str::plural('office', count($selectedRows)) }}
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
                                    <th class="align-middle">#</th>
                                    <th class="align-middle">
                                        @lang('site.office')
                                        <span wire:click="sortBy('title')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'title' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'title' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th>
                                    <th class="align-middle">
                                        @lang('site.director')
                                    </th>
                                    <th class="align-middle" scope="col">@lang('site.directorSignature')</th>
                                    <th class="align-middle" scope="col">@lang('site.assistantSignature')</th>
                                    <th class="align-middle">
                                        @lang('site.status')
                                        <span wire:click="sortBy('status')" class="text-sm float-sm-right" style="cursor: pointer;font-size:10px;">
                                            <i class="mr-1 fa fa-arrow-up" style="color:{{ $sortColumnName === 'status' && $sortDirection === 'asc' ? '#90EE90' : '' }}"></i>
                                            <i class="fa fa-arrow-down" style="color : {{ $sortColumnName === 'status' && $sortDirection === 'desc' ? '#90EE90' : '' }}"></i>
                                        </span>
                                    </th class="align-middle">
                                    <th colspan="2">@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($offices as $office)
                                    <tr>
                                        <td scope="col" class="align-middle">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" wire:model="selectedRows" value="{{ $office->id }}" class="custom-control-input" id="{{ $office->id }}">
                                                <label class="custom-control-label" for="{{ $office->id }}"></label>
                                            </div>
                                        </td>
                                        <td class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $office->name }}</td>
                                        <td class="align-middle">{{ $office->director }}</td>
                                        <td class="align-middle">
                                            <img src="{{ $office->director_url }}" style="width: 50px;" class="img" alt="">
                                            @if ($office->director_signature_path)
                                                <button wire:click.prevent="removeDirectorImage({{ $office->id }})" class="btn btn-outline-danger btn-xs">@lang('site.removeImage')</button>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <img src="{{ $office->assistant_url }}" style="width: 50px;" class="img" alt="">
                                            @if ($office->assistant_signature_path)
                                                <button wire:click.prevent="removeAssistantImage({{ $office->id }})" class="btn btn-outline-danger btn-xs">@lang('site.removeImage')</button>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <span  class="font-weight-bold badge text-white {{ $office->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $office->status() }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <button wire:click.prevent="edit({{ $office }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                                @if (auth()->user()->roles[0]->name == 'superadmin')
                                                    <button wire:click.prevent="confirmOfficeRemoval({{ $office->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash bg-danger"></i></button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash bg-danger"></i></button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">@lang('site.noDataFound')</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-light">
                    {!! $offices->appends(request()->all())->links() !!}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal Create or Update office -->

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateOffice' : 'createOffice' }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal)
                                <span>@lang('site.updateRecord', ['name' => 'مكتب / إدارة'])</span>
                            @else
                                <span>@lang('site.addRecord', ['name' => 'مكتب / إدارة'])</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="col-12">
                                <!-- Modal Office Name -->
                                <div class="form-group">
                                    <label for="title">@lang('site.office')</label>
                                    <input type="text" wire:model.defer="data.name" class="form-control @error('title') is-invalid @enderror" id="title" aria-describedby="titleHelp" dir="rtl" placeholder="@lang('site.enterFieldName', ['name' => 'اسم المكتب / الإدارة'])">
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Modal director -->
                                <div class="form-group">
                                    <label for="director">@lang('site.director')</label>
                                    <input type="text" wire:model.defer="data.director" class="form-control @error('director') is-invalid @enderror" id="director" aria-describedby="directorHelp" dir="rtl" placeholder="@lang('site.enterFieldName', ['name' => 'اسم المدير'])">
                                    @error('director')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Modal director signature -->
                                <div class="form-group">
                                    <label for="custom-file">@lang('site.directorSignature')</label>
                                    @if ($director_signature_image)
                                        <img src="{{ $director_signature_image->temporaryUrl() }}" class="mb-2 d-block img img-circle" width="100px" alt="">
                                    @else
                                        <img src="{{ $data['director_url'] ?? '' }}" class="mb-2 d-block img img-circle" width="100px" alt="">
                                    @endif
                                    <div class="mb-3 custom-file">
                                        <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <input wire:model="director_signature_image" type="file" class="custom-file-input @error('director_signature_image') is-invalid @enderror" id="validatedCustomFile">
                                            {{-- progres bar --}}
                                            <div x-show.transition="isUploading" class="mt-2 rounded progress progress-sm">
                                                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="custom-file-label" for="customFile">
                                            @if ($director_signature_image)
                                                {{ $director_signature_image->getClientOriginalName() }}
                                                <img src="{{ $director_signature_image }}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                            @else
                                                @lang('site.chooseImage')
                                            @endif
                                        </label>
                                    </div>
                                </div>


                                <!-- Modal assistant signature -->

                                <div class="form-group">
                                    <label for="custom-file">@lang('site.assistantSignature')</label>
                                    @if ($assistant_signature_image)
                                        <img src="{{ $assistant_signature_image->temporaryUrl() }}" class="mb-2 d-block img img-circle" width="100px" alt="">
                                    @else
                                        <img src="{{ $data['assistant_url'] ?? '' }}" class="mb-2 d-block img img-circle" width="100px" alt="">
                                    @endif
                                    <div class="mb-3 custom-file">
                                        <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                            <input wire:model="assistant_signature_image" type="file" class="custom-file-input @error('assistant_signature_image') is-invalid @enderror" id="validatedCustomFile">
                                            {{-- progres bar --}}
                                            <div x-show.transition="isUploading" class="mt-2 rounded progress progress-sm">
                                                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                    <span class="sr-only">40% Complete (success)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <label class="custom-file-label" for="customFile">
                                            @if ($assistant_signature_image)
                                                {{ $assistant_signature_image->getClientOriginalName() }}
                                                <img src="{{ $assistant_signature_image }}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                            @else
                                                @lang('site.chooseImage')
                                            @endif
                                        </label>
                                    </div>
                                </div>
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

    <!-- Modal Delete Office -->

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5>@lang('site.deleteRecord', ['name' => 'مكتب / إدارة'])</h5>
                </div>

                <div class="modal-body">
                    <h4>@lang('site.deleteMessage')</h4>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> @lang('site.cancel')</button>
                    <button type="button" wire:click.prevent="deleteOffice" class="btn btn-danger"><i class="mr-1 fa fa-trash"></i>@lang('site.delete')</button>
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
