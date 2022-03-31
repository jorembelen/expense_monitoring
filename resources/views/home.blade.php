@extends('layouts.master')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>


        </div>
    </div>
</div>
<!-- end page title -->

<div class="card overflow-hidden">
    <div class="bg-primary bg-soft">
        <div class="row">
            <div class="col-7 mt-4">
                <div class="text-primary p-3">
                    <h1 class="text-primary">{{ auth()->user()->userGreetings() }} </h1>
                </div>
            </div>
            <div class="col-3 align-self-end">
                <img src="assets/images/dashboard-new.svg" alt="" class="img-fluid">
            </div>
        </div>
    </div>


    <div class="card-body pt-0">
        <div class="row">
            <div class="col-sm-4">
                <div class="avatar-md profile-user-wid mb-4">
                    <img avatar="{{ auth()->user()->name }}" alt="" class="img-thumbnail rounded-circle">
                </div>
                <h5 class="font-size-15 text-truncate">{{ auth()->user()->name }}</h5>
                <p class="text-muted mb-0 text-truncate">{{ auth()->user()->role() }}</p>
            </div>
        </div>
    </div>

</div>

@if (auth()->user()->role_id == 1)
    <div class="row">
        <div class="col-md-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Total Employees</p>
                            <h4 class="mb-0">{{ number_format($totalEmp, ) }}</h4>

                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title">
                                    <i class="bx bxs-user-detail font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Total Cash Advance</p>
                            <h4 class="mb-0">{{ number_format($totalCashAdvance, 2) }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center ">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-dollar-circle font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium">Cash Available</p>
                            <h4 class="mb-0">{{ number_format($totalCash->balance, 2) }}</h4>
                        </div>

                        <div class="flex-shrink-0 align-self-center">
                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bx-dollar-circle font-size-24"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@elseif (auth()->user()->role_id == 2)
<div class="col-md-4">
    <div class="card mini-stats-wid">
        <div class="card-body">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <p class="text-muted fw-medium">Total Cash Advance</p>
                    <h4 class="mb-0">{{ number_format($totalCashAdvance, 2) }}</h4>
                </div>

                <div class="flex-shrink-0 align-self-center ">
                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                        <span class="avatar-title rounded-circle bg-primary">
                            <i class="bx bx-dollar-circle font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection


