<div>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Cash Advance for Approval</h4>


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
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($advances as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->job_no }}</td>
                                        <td>{{ number_format($item->amount, 2) }}</td>
                                        <td>{{ number_format($item->amount / 3.75, 2) }}</td>
                                        <td>{{ $item->created_at->format('Y-M-d') }}</td>
                                        <td>
                                            <a href="#" wire:click.prevent="approve('{{ $item->id }}')"><span class="badge badge-pill badge-soft-danger font-size-12">Click to Approve</span></a>
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



</div>
