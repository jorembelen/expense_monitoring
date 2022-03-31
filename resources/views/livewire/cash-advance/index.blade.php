<div>

       <!-- start page title -->
       <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cash Advance List</h4>


            </div>
        </div>
    </div>
    <!-- end page title -->




                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif


                                <div class="mt-4">
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Job No.</th>
                                                    <th>Amount in SAR</th>
                                                    <th>Amount in Dollars</th>
                                                    <th>Request Date</th>
                                                    <th>Approved by</th>
                                                    <th>Approval Date</th>
                                                    <th>Paid by</th>
                                                    <th>Payment Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($advances as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->job_no }}</td>
                                                    <td>{{ number_format($item->amount, 2) }}</td>
                                                    <td>${{ number_format($item->amount / 3.75, 2) }}</td>
                                                    <td>{{ $item->created_at->format('Y-M-d') }}</td>
                                                    <td>{{ $item->approval[0]->approved_by ?? null }}</td>
                                                    <td>
                                                        @if ($item->approval_status == 2)
                                                        {{ date('Y-M-d', strtotime($item->approval[0]->approval_date)) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->payment[0]->paid_by ?? null }}</td>
                                                    <td>
                                                        @if ($item->payment_status == 2)
                                                        {{ date('Y-M-d', strtotime($item->payment[0]->payment_date)) }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->approval_status == 0)
                                                        <a href="#" wire:click.prevent="add('{{ $item->id }}')"><span class="badge badge-pill badge-soft-danger font-size-12">Pending</span></a>
                                                        @elseif ($item->approval_status == 1)
                                                        <span class="badge badge-pill badge-soft-warning font-size-12">For Approval</span>
                                                        @elseif ($item->payment_status == 1)
                                                        <a href="#" wire:click.prevent="pay('{{ $item->id }}')"><span class="badge badge-pill badge-soft-primary font-size-12">Pay Now</span></a>
                                                        @else
                                                        <span class="badge badge-pill badge-soft-success font-size-12">Paid</span>
                                                        @endif

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


    <div class="modal fade" id="addJob" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request for Approval</h5>
                    <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @if ($payView)
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Voucher No.:</label>
                        <input type="text" class="form-control" wire:model.defer="voucher_no">
                        @error('voucher_no')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Reference No.:</label>
                        <input type="text" class="form-control" wire:model.defer="ref_no">
                        @error('ref_no')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Job No.:</label>
                        <input type="text" class="form-control" wire:model.defer="job_no" {{ $payView == true ? 'disabled' : '' }}>
                        @error('job_no')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Amount:</label>
                        <input type="number" class="form-control" wire:model.defer="amount" readonly>
                        @error('amount')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Purpose:</label>
                        <input type="text" class="form-control" wire:model.defer="purpose" readonly>
                        @error('purpose')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click.prevent="{{ $payView == true ? 'payNow' : 'submit' }}('{{ $jobId }}')">Submit</button>
                    <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
