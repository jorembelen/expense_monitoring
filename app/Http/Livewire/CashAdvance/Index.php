<?php

namespace App\Http\Livewire\CashAdvance;

use App\Models\CashAdvance;
use App\Models\CashBook;
use App\Models\PaymentLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $purpose, $amount, $job_no, $ref_no, $voucher_no, $jobId;
    public $payView = false;

    public function add($jobId)
    {
        $this->dispatchBrowserEvent('show-job-form');
        $ca = CashAdvance::find($jobId);
        $this->amount = $ca->amount;
        $this->purpose = $ca->purpose;
        $this->jobId = $ca->id;
    }

    public function pay($jobId)
    {
        $this->dispatchBrowserEvent('show-job-form');

        // Auto fill voucher number and reference number
        $ref = CashBook::whereNotNull('ref_no')->pluck('ref_no')->last();
        $v = CashBook::whereNotNull('voucher_no')->pluck('voucher_no')->last();
        $vo = substr($v, 0, -4);
        $v = substr($v, 7) + 1;
        $number = sprintf('%04d',$v);

        // dd($vo);
        $this->voucher_no = $vo .$number;
        $this->ref_no = $ref;

        $this->payView = true;
        $ca = CashAdvance::find($jobId);
        $this->amount = $ca->amount;
        $this->purpose = $ca->purpose;
        $this->job_no = $ca->job_no;
        $this->jobId = $ca->id;
    }



    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
    }

    public function payNow($jobId)
    {
        $this->validate([
            'voucher_no' => 'required|unique:cash_books,voucher_no',
            'ref_no' => 'required',
        ]);

        $ca = CashAdvance::find($jobId);

        $amount = CashBook::latest()->first();
        if($amount->balance >= $ca->amount){
            $balance = $amount->balance - $ca->amount;
        }else{
            session()->flash('message', 'Failed, Insufficient balance.');
            $this->dispatchBrowserEvent('hide-form');
            return redirect()->back();
        }

        DB::beginTransaction();
        if($ca){
            $ca->update([
                'payment_status' => 2,
            ]);
            CashBook::create([
                'user_id' => auth()->id(),
                'ref_no' => $this->ref_no,
                'voucher_no' => $this->voucher_no,
                'out' => $ca->amount,
                'in' => 0,
                'balance' => $balance,
            ]);
            PaymentLog::create([
                'paid_by' => auth()->user()->name,
                'payment_date' => now(),
                'cash_advance_id' => $ca->id,
            ]);
            DB::commit();
            session()->flash('message', 'Success, ' .$this->voucher_no .' was paid successfully.');
            return redirect()->route('cash-advance');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function submit($jobId)
    {
        $this->validate([
            'job_no' => 'required',
        ]);

        $ca = CashAdvance::find($jobId);

        DB::beginTransaction();
        if($ca){
            $ca->update([
                'job_no' => $this->job_no,
                'approval_status' => 1,
            ]);
            DB::commit();
            session()->flash('message', 'Success, ' .$this->job_no .' was submitted for approval.');
            return redirect()->route('cash-advance');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function render()
    {
        $advances = CashAdvance::latest()->get();

        return view('livewire.cash-advance.index', compact('advances'))->extends('layouts.master');
    }
}
