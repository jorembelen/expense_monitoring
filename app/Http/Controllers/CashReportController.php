<?php

namespace App\Http\Controllers;

use App\Http\Requests\CashReportRequest;
use App\Models\CashReport;
use App\Models\Employee;
use App\Models\GlCode;
use App\Models\ReportAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CashReportController extends Controller
{
    public function create()
    {
        $employees = Employee::latest()->get();

        return view('reports.create', compact('employees'));
    }

    public function userCreate($id)
    {
        $employees = Employee::latest()->get();

        return view('reports.user-create', compact('employees', 'id'));
    }

    public function store(CashReportRequest $request)
    {
        // dd($request->all());
        $flag = true;

        DB::beginTransaction();
        if($flag){

            $cat = count($request->invoice_date);
            if(auth()->user()->role_id == 1){
                $emp = Employee::find($request->employee_id);
                $empId = $request->employee_id;
            }else{
                $emp = Employee::whereuser_code(auth()->user()->user_code)->first();
                $empId = $emp->id;
            }

            $attachmentPath = 'uploads/attachment/';

            $emp = substr($emp->name, 0, 3) .substr($emp->name,  -3);
            $empName = strtoupper($emp);

            $code = $empName .'-' .rand(10000, 99999);

            if($request->hasfile('file')){
                $doc = $request->file('file');

                // get the name of the image
                $name = $doc->hashName();
                $doc->move($attachmentPath ,$name);
                ReportAttachment::create([
                    'batch_code' => $code,
                    'file' => $name,
                ]);
            }

            for ($i=0; $i < $cat; $i++) {

                $report = new CashReport();

                $report->user_id = auth()->id();
                $report->employee_id = $empId;
                $report->batch_code = $code;
                $report->cash_advance_id = $request->cash_advance_id[$i] ?? null;
                $report->invoice_date = $request->invoice_date[$i];
                $report->job_no = $request->job_no[$i];
                $report->gl_code_id = $request->gl_code_id[$i];
                $report->description = $request->description[$i];
                $report->type = $request->type[$i];
                $report->sar = $request->sar[$i];
                $report->save();
               }

            DB::commit();
            $flag = false;
            session()->flash('message', 'Success, Data was added successfully.');
            if(auth()->user()->role_id == 1){
                return redirect()->route('unpaid-cash-report');
            }else{
                return redirect()->route('cash-report.create');
            }
        }else{
            DB::rollBack();
            return redirect()->back();
        }

    }
}
