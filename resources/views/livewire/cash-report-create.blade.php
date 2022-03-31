
<div >

    <div class="text-sm-end">
        <button class="btn btn-primary mb-2 float-right" id="add" wire:click.prevent="add('{{ $i }}')"><i class="fa fa-plus-circle mr-1"></i> Add</button>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th >#</th>
                <th >Date</th>
                <th >GL Code & Description</th>
                <th >Job No.</th>
                <th >Description/Purpose</th>
                <th >Type</th>
                <th >SAR</th>
                <th ></th>
            </tr>
        </thead>
        <tbody>
            <h5>Total Rows: <strong>{{ $i }}</strong></h5>
            <?php $i = 0 ?>
            @foreach($inputs as $key => $value)
            <?php $i++;?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <input type="date" class="form-control"  wire:model.defer="invoice_date.{{ $value }}" name="invoice_date[]">
                </td>
                <td>
                    {{-- <input type="text" class="form-control"  wire:model.defer="gl_code_id.{{ $value }}" name="gl_code_id[]"> --}}
                           <select class="form-control" wire:model="gl_code_id.{{ $value }}" name="gl_code_id[]">
                            <option value="">Select GL Code</option>
                            @foreach ($codes as $item)
                            <option value="{{ $item->id }}">{{ $item->account_code }} -  {{ $item->account_description }}</option>
                            @endforeach
                        </select>
                </td>
                <td>
                    <input type="text" class="form-control"  wire:model.defer="job_no.{{ $value }}" name="job_no[]">
                </td>
                <td>
                    <input type="text" class="form-control"  wire:model.defer="description.{{ $value }}" name="description[]">
                </td>
                <td>
                    <select class="form-control" wire:model.defer="type.{{ $value }}" name="type[]">
                        <option value="">Select Type</option>
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
                </td>
                <td>
                    <input type="number" step="0.01" class="form-control" name="sar[]"  placeholder="Enter amount in SAR" wire:model.defer="sar.{{ $value }}">
                </td>

                <td><a href="#" class="text-danger" wire:click.prevent="remove({{ $key }})"><i class="mdi mdi-delete font-size-18"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>






