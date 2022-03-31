
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
                    <input type="date" class="form-control"  name="invoice_date.{{ $value }}">
                    @error('invoice_date')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
                <td>
                        <input type="text" class="form-control" name="gl_code_id[]"  wire:model="gl_code_id.{{ $value }}">
                        {{-- <select class="form-control" wire:model="state.type.{{ $value }}">
                            <option value="Others">Others</option>
                        </select> --}}
                </td>
                <td>
                    <input type="text" class="form-control"  name="job_no.{{ $value }}">
                    @error('job_no')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
                <td>
                    <input type="text" class="form-control"  name="description.{{ $value }}">
                    @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
                <td>
                    <select class="form-control" wire:model="state.type.{{ $value }}">
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
                    @error('description')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </td>
                <td>
                    <input type="number" step="0.01" class="form-control"  placeholder="Enter amount" wire:model="state.sar.{{ $value }}">
                    @error('sar')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </td>

                <td><a href="#" class="text-danger" wire:click.prevent="remove({{ $key }})"><i class="mdi mdi-delete font-size-18"></i></a></td>
             </tr>
             @endforeach
     </tbody>
 </table>
