<div>

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary"> Reset Password</h5>
                                        <p>Reset Password with DLPS App.</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="/assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <a href="#">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="/assets/logo.jpg" alt="" class="rounded-circle" height="50">
                                        </span>
                                    </div>
                                </a>
                            </div>

                            <div class="p-2">

                                <form wire:click.prevent="submit">
                                @if (session()->has('message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @else
                                <div class="alert alert-success text-center mb-4" role="alert">
                                    Please update your password to continue.
                                </div>
                                @endif

                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Password</label>
                                        <input type="password" class="form-control" wire:model.defer="password" placeholder="Enter new password">
                                        @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="useremail" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" wire:model.defer="password_confirmation" placeholder="Confirm new password">
                                        @error('password_confirmation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="text-end">
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

</div>
