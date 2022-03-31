<div>

       <!-- start page title -->
       <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Add Voucher</h4>

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

                @if ($editMode)
                <div class="card-body table-responsive">
                    <table  class="table table-bordered dt-responsive  nowrap w-100">
                        <thead>
                            <tr>
                                <th >Date </th>
                                <th >GL Code</th>
                                <th >Job No.</th>
                                <th >Description/Purpose</th>
                                <th >Type</th>
                                <th >SAR</th>
                                <th ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="date" class="form-control"   wire:model="state.invoice_date">
                                    @error('invoice_date')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control"  wire:model.defer="state.gl_code_id">
                                    @error('gl_code_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control"  wire:model.defer="state.job_no">
                                    @error('job_no')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="text" class="form-control"  wire:model.defer="state.description">
                                    @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control" wire:model.defer="state.type">
                                        <option value="{{ $type }}">{{ $type }}</option>
                                        <option value="Coffee Items">Coffee Items</option>
                                        <option value="Water">Water</option>
                                        <option value="Phone Credit">Phone Credit</option>
                                        <option value="Internet Recharge">Internet Recharge</option>
                                        <option value="Cleaning Items">Cleaning Items</option>
                                        <option value="Food Stuff">Food Stuff</option>
                                        <option value="Gasoline">Gasoline</option>
                                        <option value="Shop Tools">Shop Tools</option>
                                        <option value="Supplies">Supplies</option>
                                        <option value="Others">Others</option>
                                    </select>
                                    @error('type')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" step="0.01" class="form-control"  placeholder="Enter amount in SAR" wire:model.defer="state.sar">
                                    @error('sar')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>

                            </tr>
                        </tbody>
                    </table>
                    <div class="row justify-content-end text-sm-end">
                        <div>
                            <button type="button" class="btn btn-primary w-md" wire:click.prevent="update({{ $reportId }})">Submit</button>
                            <button type="button" class="btn btn-danger w-md" wire:click.prevent="cancel">Cancel</button>
                        </div>
                    </div>
                </div>
                @else
                <div class="card-body">
                    <h2 class=" mb-4 text-center">Batch Code: {{ $code }}</h2>

                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  placeholder="Enter Your Reference Number" wire:model.defer="reference_no">
                        </div>
                        @error('reference_no')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <input type="text" class="form-control"  placeholder="Enter Your Voucher Number" wire:model.defer="voucher_no">
                        </div>
                        @error('voucher_no')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <th>Action</th>
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
                                    <td>
                                        <div class="d-flex gap-3">
                                            <a href="#" class="text-success" wire:click.prevent="edit({{ $report }})"><i class="mdi mdi-pencil font-size-18"></i></a>
                                            <a href="#" class="text-danger" wire:click.prevent="delete({{ $report->id }})"><i class="mdi mdi-delete font-size-18"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-end text-sm-end">
                        <div>
                            <a href="#" class="btn btn-primary w-md" wire:click.prevent="pay('{{ $code }}')">Process for Approval</a>
                        </div>
                    </div>
                </div>



            </div>
            @endif

        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
<!-- end col -->

</div>
