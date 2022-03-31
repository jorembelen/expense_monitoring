@extends('layouts.master')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Filtered Reports</h4>


        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">


                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive">


                    <table id="datatable-buttons"  class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>JDE Code</th>
                                <th>GL Description</th>
                                <th>Description/Purpose</th>
                                <th>Voucher No.</th>
                                <th>Payment in SAR</th>
                                <th>Payment in Dollar</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->job_no }}.{{ $report->code->account_code }}</td>
                                <td>{{ $report->code->account_description }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->voucher_no }}</td>
                                <td>{{ number_format($report->sar, 2) }}</td>
                                <td>${{ number_format($report->sar / 3.75, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end col -->

                <div class="row">
                    <div class="col-md-3">
                        <h5>Total in SAR: {{ number_format($reports->sum('sar'), 2) }}</h5>
                    </div>
                    <div class="col-md-3">
                        <h5>Total in Dollars: ${{ number_format($reports->sum('sar') / 3.75, 2) }}</h5>
                    </div>
                </div>

            </div>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
<!-- end col -->

@endsection
