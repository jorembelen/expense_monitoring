@extends('layouts.master')


@section('content')
<style>
    .disabled-btn {
        display: none;
    }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Add Expense Report</h4>


        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">

                @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form class="form-disabled-button" action="{{ route('report.store') }}" method="POST" id="report-store" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="cash_advance_id" value="{{ $id }}">
                    <div class="col-md-6">
                        <div class="mb-3">
                            @if (auth()->user()->role_id == 1)
                            <label for="formrow-password-input" class="form-label">Paid To</label>
                            <select class="form-control select2" name="employee_id" >
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @else
                            <label for="formrow-password-input" class="form-label">Name</label>
                            <h3>{{ auth()->user()->name }}</h3>
                            @endif

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="file" class="form-control" name="file" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Attach File</label>
                            </div>
                        </div>
                    </div>

                    @livewire('cash-report-create')

                    <div class="text-sm-end mt-4">
                        <button type="submit" class="btn btn-primary w-md enabled-btn" wire:click.prevent="submit">Submit</button>
                        <button type="button" class="btn btn-dark waves-effect waves-light disabled-btn">
                            <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Processing
                        </button>
                          @if (auth()->user()->role_id == 1)
                          <a href="{{ route('cash-report') }}"  class="btn btn-danger w-md">Cancel</a>
                          @else
                          <a href="{{ route('home') }}"  class="btn btn-danger w-md">Cancel</a>
                          @endif
                    </div>
                </form>

            </div>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
<!-- end col -->

</div>

@endsection



@push('btn-js')

<script>
    (function(){
        $('.form-disabled-button').on('submit', function() {
            $('.enabled-btn').hide();
            $('.disabled-btn').show();
            setTimeout(function() {
                $('.enabled-btn').show();
                $('.disabled-btn').hide();
            }, 5000);
        })
    })();
</script>

@endpush
