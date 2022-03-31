@extends('layouts.master')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Print Report</h4>


        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {{-- <div class="invoice-title">
                    <h4 class="float-end font-size-22">Voucher # {{ $id }}</h4>
                    <div class="row">
                        <div class="col-sm-2 mt-2 text-center">
                            <div class="mb-4">
                                <img src="/assets/logo.jpg" alt="logo" height="55" width="125"/>
                            </div>
                        </div>
                        <div class="col-sm-2 mt-2 text-center">
                            <div class="mb-4">
                                <img src="/assets/dlps-logo.png" alt="logo" height="55" width="125"/>
                            </div>
                        </div>
                    </div>
                </div>
                <hr> --}}
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <strong>Diversified Lines for Petroleum Services (DLPS)</strong><br>
                            Bulding #39, Doha District,  <br>
                            Al Khobar 31953. KSA <br>
                            Phone: +933 (3) 861-7000 <br>
                            FAx : +933 (3) 861-1222        <br>   <br>
                        </address>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <img src="/assets/logo.jpg" alt="logo" height="55" width="100"/>
                        <img src="/assets/dlps-logo.png" alt="logo" height="55" width="100"/>
                        {{-- <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                        </div> --}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mt-3">
                        <address>
                            <strong>Employee Information:</strong><br>
                            <h4>{{$empName}}</h4>
                        </address>
                    </div>
                    <div class="col-sm-6 mt-3 text-sm-end">
                        <address>
                            <strong>Voucher #:</strong><br>
                            <h4>{{$id}}</h4>
                        </address>
                    </div>
                </div>
                <hr>
                <div class="py-2 ">
                    <h3 class="font-size-15 fw-bold">Expense summary</h3>
                </div>
                <div class="table-responsive">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>GL Account</th>
                                <th>GL Description</th>
                                <th>Job No.</th>
                                <th>Description/Purpose</th>
                                <th>Payment in SAR</th>
                                <th>Payment in Dollar</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->invoice_date->format('Y-M-d') }}</td>
                                <td>{{ $report->code->account_code }}</td>
                                <td>{{ $report->code->account_description }}</td>
                                <td>{{ $report->job_no }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ number_format($report->sar, 2) }}</td>
                                <td>${{ number_format($report->sar / 3.75, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h6>Total Amount in SAR: {{ number_format($reports->sum('sar'), 2) }}</h6>
                    </div>
                    <div class="col-md-4">
                        <h6>Total Amount in Dollars: ${{ number_format($reports->sum('sar') / 3.75, 2) }}</h6>
                    </div>
                </div>
                <br>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <h6>Prepared by:</h6> <br>
                        <h5>{{ auth()->user()->name }}</h5>
                    </div>
                    <div class="col-md-3">
                        @php
                            $approval = \App\Models\ApprovalLog::wherevoucher_no($id)->first();
                        @endphp
                        <h6>Approved by:</h6> <br>
                        <h5>{{ $approval->approved_by }}</h5>
                    </div>
                    <div class="col-md-3">
                        <h6>Received by:</h6> <br>

                    </div>
                    <div class="col-md-3">
                        <h6>Accounted by:</h6> <br>
                    </div>
                </div>
                <div class="d-print-none">
                    <div class="float-end">
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
