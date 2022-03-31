
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
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <a href="{{ route('cash-report.create') }}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                    <i class="mdi mdi-plus me-1"></i> Add New Report
                                </a>
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
                                    <th>Reference No.</th>
                                    <th>Voucher No.</th>
                                    <th>Paid To</th>
                                    <th>Amount in SAR</th>
                                    <th>Amount in Dollar</th>
                                    <th>Approved By</th>
                                    <th>Approval Date</th>
                                    <th>Paid By</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $report[0]->ref_no }}</td>
                                    <td>
                                        <a href="{{ route('voucher.report', $report[0]->voucher_no) }}">{{ $report[0]->voucher_no }}</a>
                                    </td>
                                    <td>{{ $report[0]->employee->name }}</td>
                                    <td>{{ number_format($report->sum('sar'), 2) }}</td>
                                    <td>${{ number_format($report->sum('sar') / 3.75, 2) }}</td>
                                    @php
                                        $approval = \App\Models\ApprovalLog::wherevoucher_no($report[0]->voucher_no)->first();
                                        $payment = \App\Models\PaymentLog::wherevoucher_no($report[0]->voucher_no)->first();
                                    @endphp
                                        <td>{{ $approval->approved_by ?? null }}</td>
                                        <td>
                                            @if ($approval)
                                            {{ date('Y-M-d', strtotime($approval->approval_date)) ?? null }}
                                            @endif
                                        </td>
                                    <td>{{ $payment->paid_by ?? null }}</td>
                                    <td>
                                            @if ($payment)
                                            {{ date('Y-M-d', strtotime($payment->payment_date)) ?? null }}
                                            @endif
                                        </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-{{ $report[0]->payment_status == 0 ? 'danger' : 'primary' }} font-size-12">
                                        @if ($report[0]->payment_status == 0 && $report[0]->approval_status == 1)
                                            Pending
                                        @elseif ($report[0]->payment_status == 0 && $report[0]->approval_status == 2)
                                            Unpaid
                                        @else
                                            Paid
                                        @endif
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{ $reports->links() }} --}}

                    </div> <!-- end col -->

                </div>

            </div>

        </div>
    </div>

</div>


