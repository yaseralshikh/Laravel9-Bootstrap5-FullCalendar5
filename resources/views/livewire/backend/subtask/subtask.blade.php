<div>
    @section('style')
        <style>
            .disabled-link{
                cursor: default;
                pointer-events: none;
                text-decoration: none;
                color: rgb(174, 172, 172);
            }
            .draggable-mirror{
                background-color: white;
                width: 950px;
                display: flex;
                justify-content: space-between;
                box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
            }
        </style>
    @endsection

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1 class="m-0">Subtasks</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Subtasks</li>
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
                        <button wire:click.prevent='addNewSubtask' class="ml-1 btn btn-sm btn-primary">
                            <i class="mr-2 fa fa-plus-circle"
                                aria-hidden="true">
                                <span>Add New Subtask</span>
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

                        <label class="flex-wrap">Total Subtasks : &nbsp{{ $subtasks->total() }}</label>

                    </div>

                    @if ($selectedRows)
                        <span class="mb-2 text-success">
                            <i class="fa fa-level" aria-hidden="true"></i>
                            selected
                            <span class="text-dark font-weight-bold">{{ count($selectedRows) }}</span> {{ Str::plural('subtask', count($selectedRows)) }}
                            <a class="ml-2 text-gray" href="" wire:click="resetSelectedRows" data-toggle="tooltip" data-placement="top" title="Reset Selected Rows"><i class="fas fa-times"></i></a>
                        </span>
                    @endif

                    <div class="table-responsive">
                        <table id="example2"  class="table text-center table-hover dataTable dtr-inline" aria-describedby="example2_info">
                            <thead class="bg-light">
                                <tr>
                                    <th></th>
                                    <th scope="col">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" wire:model="selectPageRows" value="" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck"></label>
                                        </div>
                                    </th>
                                    <th>#</th>
                                    <th>Subtask</th>
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
                            <tbody wire:sortable="updateSubtaskPosition">
                                @forelse ($subtasks as $subtask)
                                    <tr wire:sortable.item="{{ $subtask->id }}" wire:key="subtask-{{ $subtask->id }}">
                                        <td wire:sortable.handle style="width:10px; cursor: move;" width="10px"><i class="fa fa-arrows-alt text-muted"></i></td>
                                        <td scope="col">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" wire:model="selectedRows" value="{{ $subtask->id }}" class="custom-control-input" id="{{ $subtask->id }}">
                                                <label class="custom-control-label" for="{{ $subtask->id }}"></label>
                                            </div>
                                        </td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td dir="rtl" class="text-justify" tabindex="0">{{ $subtask->title }}</td>
                                        <td>
                                            <span  class="font-weight-bold badge text-white {{ $subtask->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $subtask->status() }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button wire:click.prevent="edit({{ $subtask }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                                                @if (auth()->user()->roles[0]->name == 'superadmin')
                                                    <button wire:click.prevent="confirmSubtaskRemoval({{ $subtask->id }})" class="btn btn-danger btn-sm"><i class="fa fa-trash bg-danger"></i></button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" disabled><i class="fa fa-trash bg-danger"></i></button>
                                                @endif
                                            </div>
                                            {{-- <form action="" method="post" id="delete-subtask-{{ $subtask->id }}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No Subtasks found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            {{-- <tfoot>
                                <tr>
                                    <td colspan="5">
                                        {!! $subtasks->appends(request()->all())->links() !!}
                                    </td>
                                </tr>
                            </tfoot> --}}
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer bg-light">
                    {!! $subtasks->appends(request()->all())->links() !!}
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- Modal Create or Update Subtask -->

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateSubtask' : 'createSubtask' }}">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal)
                                <span>Edit Subtask</span>
                            @else
                            <span>Add New Subtask</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="col-12">

                                <!-- Modal Subtask Title -->

                                <div class="form-group">
                                    <label for="title">Subtask</label>

                                    <textarea dir="rtl" tabindex="1" wire:model.defer="data.title" class="text-justify form-control @error('title') is-invalid @enderror" rows="3"  id="title" aria-describedby="titleHelp" placeholder="Enter Subtask .."></textarea>
                                    @error('title')
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

    <!-- Modal Delete Subtask -->

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5>Delete Subtask</h5>
                </div>

                <div class="modal-body">
                    <h4>Are you sure you want to delete this subtask?</h4>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="mr-1 fa fa-times"></i> Cancel</button>
                    <button type="button" wire:click.prevent="deleteSubtask" class="btn btn-danger"><i class="mr-1 fa fa-trash"></i>Delete Subtask</button>
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
