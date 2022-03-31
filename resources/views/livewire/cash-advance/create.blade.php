<div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cash Advance Requests List</h4>

                <div class="text-sm-end">
                    <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" wire:click.prevent="add"><i class="mdi mdi-plus me-1"></i> Request New CA</button>
                </div>

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
                                        <th>Status</th>
                                        <th>Liquidated Amount</th>
                                        <th>Action</th>
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
                                        <td>
                                            <span class="badge badge-pill badge-soft-{{ $item->approval_status == 0 ? 'danger' : 'primary' }} font-size-12">
                                                @if ($item->approval_status == 0)
                                                Pending
                                                @elseif ($item->approval_status == 1)
                                                For Approval
                                                @else
                                                Approved
                                                @endif
                                            </span>
                                        </td>
                                        <td>{{ number_format($item->totalLiquidated(), 2) }}</td>
                                        <td>
                                            @if ($item->approval_status == 2)
                                            <a href="{{ route('user-cash-report.create', $item->id) }}">  <span class="badge badge-pill badge-soft-success font-size-12">Add Expense Report</span></a>
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



    <div class="modal fade" id="addCa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request CA</h5>
                    <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Amount:</label>
                        <input type="number" class="form-control" wire:model.defer="amount">
                        @error('amount')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Purpose:</label>
                        <input type="text" class="form-control" wire:model.defer="purpose">
                        @error('purpose')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click.prevent="submit">Submit</button>
                    <button type="button" class="btn btn-secondary" wire:click.prevent="close">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>
