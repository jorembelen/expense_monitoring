<?php

namespace App\Http\Livewire;

use App\Models\ApprovalLog;
use App\Models\CashReport;
use Livewire\Component;

class ForApproval extends Component
{
    public $code;

    public function approve($code)
    {
        $vouchers = CashReport::wherevoucher_no($code)->get();
        foreach($vouchers as $voucher){
            $voucher->update([
                'approval_status' => 2,
            ]);
            ApprovalLog::create([
                'approved_by' => auth()->user()->name,
                'approval_date' => now(),
                'voucher_no' => $voucher->voucher_no,
            ]);
        }
        session()->flash('message', 'Success, Voucher No.: ' .$this->code .' was approved successfully.');
        return redirect()->route('for-approval-list');
    }

    public function mount($code)
    {
        $this->code = $code;
    }

    public function render()
    {
        $reports = CashReport::wherevoucher_no($this->code)->get();

        return view('livewire.for-approval', compact('reports'))->extends('layouts.master');
    }
}
