<div>

     <!-- start page title -->
     <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Employees List</h4>


            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 col-sm-12">
            <div class="card">
                <div class="card-body">


                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive">
                        <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" wire:click.prevent="addEmp">
                                <i class="mdi mdi-plus me-1"></i> Add New Employee
                            </button>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div id="datatable_filter" class="dataTables_filter"><label>Search:
                                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="datatable" wire:model.debounce.500ms="query"></label>
                            </div>
                        </div>
                    </div>

                    <table  class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Nationality</th>
                                        <th>Type</th>
                                        <th>UserCode</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->position }}</td>
                                        <td>{{ $employee->nationality }}</td>
                                        <td>{{ $employee->type }}</td>
                                        <td>{{ $employee->user_code }}</td>
                                        <td>
                                            <div class="d-flex gap-3">
                                                <a href="#" class="text-success" wire:click.prevent="editEmp({{ $employee }})"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                <a href="#" class="text-danger" wire:click.prevent="deleteEmp({{ $employee }})"><i class="mdi mdi-delete font-size-18"></i></a>
                                                <a href="#" wire:click.prevent="addUser({{ $employee->id }})"><span class="badge bg-primary">Add as User</span></a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $employees->links() }}
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>


        <div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Employee</h5>
                        <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" wire:model.defer="name">
                                @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Position:</label>
                                <input type="text" class="form-control" wire:model.defer="position">
                                @error('position')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Nationality:</label>
                                <input type="text" class="form-control" wire:model.defer="nationality">
                                @error('nationality')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Type:</label>
                                <input type="text" class="form-control" wire:model.defer="type">
                                @error('type')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click.prevent="add">Submit</button>
                        <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                    </div>
                </div>
            </div>
        </div>

        @if ($editMode)
            <div class="modal fade" id="editEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update {{ $name }} </h5>
                            <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" wire:model.defer="name">
                                    @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Job Code:</label>
                                    <input type="text" class="form-control" wire:model.defer="job_code">
                                    @error('job_code')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" wire:click.prevent="update">Submit</button>
                            <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($deleteMode)
            <div class="modal fade" id="deleteEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-delete font-size-18 text-danger"></i> Delete {{ $name }} </h5>
                            <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Are you sure? This data will be lost forever.</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" wire:click.prevent="delete">Submit</button>
                            <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                        <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" wire:model.defer="state.user-name" readonly>
                                @error('user-name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" wire:model.defer="state.email">
                                @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Username:</label>
                                <input type="text" class="form-control" wire:model.defer="state.username">
                                @error('username')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">UserCode:</label>
                                <input type="text" class="form-control" wire:model.defer="state.user_code" readonly>
                                @error('user_code')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click.prevent="submitUser({{ $empId }})">Submit</button>
                        <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                    </div>
                </div>
            </div>
        </div>
