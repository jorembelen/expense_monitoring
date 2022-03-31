
<div>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cash Reports List</h4>



            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer table-responsive">

                        <table id="datatable"  class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Batch Code</th>
                                    {{-- <th>Paid To</th>
                                    <th>Invoice Date</th> --}}
                                    <th>GL Code</th>
                                    <th>GL Description</th>
                                    <th>Job Number</th>
                                    <th>Description/Purpose</th>
                                    <th>Type</th>
                                    <th>Amount in SAR</th>
                                    <th>Amount in Dollar</th>
                                    <th>Status</th>
                                    <th>Processed By</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($report[0]->approval_status == 0)
                                        <a href="{{ route('voucher.create', $report[0]->batch_code) }}">{{ $report[0]->batch_code }}</a>
                                        @else
                                        {{ $report[0]->batch_code }}
                                        @endif
                                    </td>
                                    {{-- <td>{{ $report[0]->employee->name }}</td>
                                    <td>{{ $report[0]->invoice_date->format('Y-m-d') }}</td> --}}
                                    <td>{{ $report[0]->code->account_code }}</td>
                                    <td>{{ $report[0]->code->account_description }}</td>
                                    <td>{{ $report[0]->job_no }}</td>
                                    <td>{{ $report[0]->description }}</td>
                                    <td>{{ $report[0]->type }}</td>
                                    <td>{{ number_format($report->sum('sar'), 2) }}</td>
                                    <td>${{ number_format($report->sum('sar') / 3.75, 2) }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-{{ $report[0]->approval_status == 0 ? 'danger' : 'primary' }} font-size-12">{{ $report[0]->approval_status == 0 ? 'Pending' : 'Approved' }}</span>
                                    </td>
                                    <td>{{ $report[0]->user->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div> <!-- end col -->

                </div>

            </div>

        </div>
    </div>

</div>


