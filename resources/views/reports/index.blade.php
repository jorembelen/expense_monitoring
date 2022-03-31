@extends('layouts.master')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Reports</h4>


        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                @if (session()->has('message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('filter.reports') }}" method="get">

                    <div class="row">

                        <div class="col-md-3 col-sm-6">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">Reference Number</label>
                                <select  class="form-control select2" name="ref_no">
                                    <option value="">Choose...</option>
                                    @foreach ($refs as $ref)
                                    <option value="{{ $ref }}">{{ $ref }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="mb-3">
                                <label for="formrow-job_no-input" class="form-label">Job Number</label>
                                <select  class="form-control select2" name="job_no">
                                    <option value="">Choose...</option>
                                    @foreach ($jobs as $job)
                                    <option value="{{ $job }}">{{ $job }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">GL Code</label>
                                <input  class="form-control" name="gl_code">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">From</label>
                                <input type="date" class="form-control" id="formrow-firstname-input" placeholder="Enter Your First Name" name="start_date">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="formrow-firstname-input" class="form-label">To</label>
                                <input type="date" class="form-control" id="formrow-firstname-input" placeholder="Enter Your First Name" name="end_date">
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-sm-end">
                        <button type="submit" class="btn btn-primary waves-effect waves-light ">
                            <i class="bx bx-filter-alt font-size-16 align-middle me-2 "></i> Filter
                        </button>

                    </div>

                </form>


            </div>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
<!-- end col -->

@endsection
