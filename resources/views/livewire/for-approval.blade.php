<div>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">For Approval</h4>


            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-12 col-sm-12">
            <div class="card">
                <div class="card-body">

                    <div class="card-body">
                        <h2 class=" mb-4 text-center">Voucher No. : {{ $code }}</h2>




                        @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @php
                        $report = \App\Models\CashReport::wherevoucher_no($code)->first();
                        $attachment = \App\Models\ReportAttachment::wherebatch_code($report->batch_code)->first();
                        @endphp

                        @if ($attachment)
                        <div class="mb-2">
                            <a href="{{ url('/uploads/attachment/'.$attachment->file) }}" class="btn btn-outline-success waves-effect waves-light" target="_blank" rel="noopener noreferrer"><i class="bx bx-file"></i> View Attachment</a>
                        </div>
                        @endif

                        <div class="table-responsive">
                            <table  class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Paid To</th>
                                        <th>Invoice Date</th>
                                        <th>GL Code</th>
                                        <th>GL Description</th>
                                        <th>Job Number</th>
                                        <th>Description/Purpose</th>
                                        <th>Amount in SAR</th>
                                        <th>Amount in Dollar</th>
                                        <th>Process By</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $report->employee->name }}</td>
                                        <td>{{ $report->invoice_date->format('Y-m-d') }}</td>
                                        <td>{{ $report->code->account_code }}</td>
                                        <td>{{ $report->code->account_description }}</td>
                                        <td>{{ $report->job_no }}</td>
                                        <td>{{ $report->description }}</td>
                                        <td>{{ number_format($report->sar, 2) }}</td>
                                        <td>${{ number_format($report->sar / 3.75, 2) }}</td>
                                        <td>{{ $report->user->name }}</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <h5>Total Amount in SAR: {{ number_format($reports->sum('sar'), 2) }}</h5>
                            </div>
                            <div class="col-md-3">
                                <h5>Total Amount in Dollars: ${{ number_format($reports->sum('sar') / 3.75, 2) }}</h5>
                            </div>
                        </div>

                        <div class="row justify-content-end text-sm-end">
                            <div>
                                <a href="#" class="btn btn-primary w-md" wire:click.prevent="approve('{{ $code }}')">Approve Now</a>
                            </div>
                        </div>
                    </div>

                </div>
