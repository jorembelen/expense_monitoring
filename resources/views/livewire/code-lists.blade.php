<div>

     <!-- start page title -->
     <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">GL Codes List</h4>


            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-8 col-sm-12">
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
                                    @if (auth()->user()->role_id == 1)
                                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" wire:click.prevent="add">
                                        <i class="mdi mdi-plus me-1"></i> Add New Code
                                    </button>
                                    @endif
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
                                        <th>Code</th>
                                        <th>Account Description</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($codes as $code)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $code->account_code }}</td>
                                        <td>{{ $code->account_description }}</td>
                                        <td>
                                            @if (auth()->user()->role_id == 1)
                                                <div class="d-flex gap-3">
                                                    <a href="#" class="text-success" wire:click.prevent="edit({{ $code }})"><i class="mdi mdi-pencil font-size-18"></i></a>
                                                    <a href="#" class="text-danger" wire:click.prevent="delete({{ $code }})"><i class="mdi mdi-delete font-size-18"></i></a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $codes->links() }}
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>


        <div class="modal fade" id="addCode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New code</h5>
                        <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Account Code:</label>
                                <input type="text" class="form-control" wire:model.defer="account_code">
                                @error('account_code')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Business Unit:</label>
                                <input type="text" class="form-control" wire:model.defer="business_unit">
                                @error('business_unit')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Account Description:</label>
                                <input type="text" class="form-control" wire:model.defer="account_description">
                                @error('account_description')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" wire:click.prevent="addCode">Submit</button>
                        <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                    </div>
                </div>
            </div>
        </div>

        @if ($editMode)
            <div class="modal fade" id="editCode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update {{ $account_code }} </h5>
                            <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Account Code:</label>
                                    <input type="text" class="form-control" wire:model.defer="account_code">
                                    @error('account_code')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Business Unit:</label>
                                    <input type="text" class="form-control" wire:model.defer="business_unit">
                                    @error('business_unit')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Account Description:</label>
                                    <input type="text" class="form-control" wire:model.defer="account_description">
                                    @error('account_description')
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
            <div class="modal fade" id="deleteCode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="mdi mdi-delete font-size-18 text-danger"></i> Delete {{ $account_code }} </h5>
                            <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h5>Are you sure? This data will be lost forever.</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" wire:click.prevent="deleteCode">Submit</button>
                            <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
