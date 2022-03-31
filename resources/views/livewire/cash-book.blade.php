<div>

          <!-- start page title -->
          <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Cash Book</h4>

                    <div class="text-sm-end">
                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" wire:click.prevent="add"><i class="mdi mdi-plus me-1"></i> Add Wallet</button>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">
                <div class="card">

                    <div class="card-body border-top">

                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <p class="text-muted mb-2">Available Balance in SAR</p>
                                    <h5> {{ number_format($balance, 2) }}</h5>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div>
                                    <p class="text-muted mb-2">Available Balance in Dollars</p>
                                    <h5>$ {{ number_format($balance/ 3.75, 2) }}</h5>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Activities</h4>


                                    <div class="mt-4">
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-hover dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Reference No.</th>
                                                        <th>Voucher No.</th>
                                                        <th>Debit</th>
                                                        <th>Credit</th>
                                                        <th>Balance in SAR</th>
                                                        <th>Balance in Dollars</th>
                                                        <th>Transaction Date</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach ($cash as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->ref_no ?? null }}</td>
                                                        <td>{{ $item->voucher_no ?? null }}</td>
                                                        <td>{{ number_format($item->in, 2) }}</td>
                                                        <td>{{ number_format($item->out, 2) }}</td>
                                                        <td>{{ number_format($item->balance, 2) }}</td>
                                                        <td>$ {{ number_format($item->balance / 3.75, 2)  }}</td>
                                                        <td>{{ $item->created_at->format('Y-M-d') }}</td>
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

                </div>
            </div>


        </div>
        <!-- end row -->

        <div class="modal fade" id="addWallet" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Wallet</h5>
                        <button type="button" class="btn-close" wire:click.prevent="close" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Reference Number:</label>
                                <input type="text" class="form-control" wire:model.defer="ref_no">
                                @error('ref_no')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Voucher Number:</label>
                                <input type="text" class="form-control" wire:model.defer="voucher_no">
                                @error('voucher_no')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Amount:</label>
                                <input type="number" class="form-control" wire:model.defer="amount">
                                @error('amount')
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
