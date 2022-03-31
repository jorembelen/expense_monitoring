<?php

namespace App\Http\Controllers;

use App\Models\CashReport;
use App\Models\GlCode;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $codes = CashReport::pluck('gl_code_id');
        $jobs = CashReport::pluck('job_no')->unique();
        $refs = CashReport::pluck('ref_no')->unique();

        return view('reports.index', compact('codes', 'jobs', 'refs'));
    }

    public function printCashReport($id)
    {
        $reports = CashReport::wherevoucher_no($id)->get();
        $name = $reports->groupBy('employee_id');
        foreach($name as $data){
             $empName = $data[0]->employee->name;
        }

        return view('reports.print', compact('reports', 'empName', 'id'));
    }


    public function filter(Request $request)
    {
        $reports = new CashReport();

        $code = GlCode::whereaccount_code($request->gl_code)->first();
        if($code){
            if($request->gl_code) {
                $reports =  $reports->wheregl_code_id($code->id);
            };
        }

        if($request->job_no) {
            $reports =  $reports->wherejob_no($request->job_no);
        }

        if($request->ref_no) {
            $reports =  $reports->whereref_no($request->ref_no);
        }

        if($request->start_date) {
            $reports = $reports->where('payment_date', '>=', $request->start_date);
        }

        if($request->end_date) {
            $reports = $reports->where('payment_date', '<=', $request->end_date);
        }

        $reports = $reports->wherepayment_status(1)->latest()->get();

        if($reports->count() > 0){
            return view('reports.filtered', compact('reports'));
        }else{
            session()->flash('message', 'Failed, No data available!');
            return redirect()->back();
        }

    }

}
