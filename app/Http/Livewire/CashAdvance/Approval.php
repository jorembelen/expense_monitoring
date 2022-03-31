<?php

namespace App\Http\Livewire\CashAdvance;

use App\Models\ApprovalLog;
use App\Models\CashAdvance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Approval extends Component
{
    public $jobId;

    public function approve($jobId)
    {
        $ca = CashAdvance::find($jobId);

        DB::beginTransaction();
        if($ca){
            $ca->update([
                'approval_date' => now(),
                'approval_status' => 2,
                'payment_status' => 1,
            ]);
            ApprovalLog::create([
                'approved_by' => auth()->user()->name,
                'approval_date' => now(),
                'cash_advance_id' => $ca->id,
            ]);

            DB::commit();
            session()->flash('message', 'Success, ' .$ca->job_no .' was successfully approved.');
            return redirect()->route('ca-approval');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function render()
    {
        $advances = CashAdvance::whereapproval_status(1)->latest()->get();

        return view('livewire.cash-advance.approval', compact('advances'))->extends('layouts.master');
    }
}
