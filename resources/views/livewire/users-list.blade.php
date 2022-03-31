<div>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Users List</h4>


            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 col-sm-12">
            <div class="card">
                <div class="card-body">

                   <div class="card-head">
                    @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                   </div>

                    <div class="table-responsive" wire:ignore>
                        <table id="datatable"  class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>UserCode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }} </td>
                                    <td>
                                        @if ($user->role_id == 1)
                                        Admin
                                        @elseif($user->role_id == 3)
                                        Manager
                                        @else
                                        User
                                        @endif
                                    </td>
                                    <td>{{ $user->user_code }}</td>
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-success" wire:click.prevent="edit({{ $user }})"><i class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="#" class="text-danger" wire:click.prevent="deleteEmp({{ $user }})"><i class="mdi mdi-delete font-size-18"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <div class="modal fade" id="EditUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                    <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" wire:model.defer="state.name" readonly>
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
                            <label for="message-text" class="col-form-label">Role:</label>
                            <select class="form-control" wire:model.defer="state.role_id">
                                <option value="{{ $role }}">
                                    @if ($role == 1)
                                    Admin
                                    @elseif($role == 3)
                                    Manager
                                    @else
                                    User
                                    @endif
                                </option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                                <option value="3">Manager</option>
                            </select>
                            @error('role_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>

                        <a href="#" wire:click.prevent="$toggle('pwUpdate')"><span class="badge badge-pill badge-soft-primary font-size-12 mb-2">Change Password</span></a>
                        @if ($pwUpdate)
                        <div class="mb-3">
                            <label for="useremail" class="form-label">New Password</label>
                            <input type="password" class="form-control" wire:model.defer="state.password" placeholder="Enter new password">
                            @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="useremail" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" wire:model.defer="state.password_confirmation" placeholder="Confirm new password">
                            @error('password_confirmation')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click.prevent="submitUser('{{ $userId }}')">Submit</button>
                    <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                </div>
            </div>
        </div>
    </div>


</div>



