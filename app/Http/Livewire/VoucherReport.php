<?php

namespace App\Http\Livewire;

use App\Models\CashBook;
use App\Models\CashReport;
use App\Models\PaymentLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VoucherReport extends Component
{
    public function mount($code)
    {
        $this->code = $code;
    }

    public function pay($code)
    {
        $vouchers = CashReport::wherevoucher_no($code)->get();
        $amount = CashBook::latest()->first();
        $out = $vouchers->sum('sar');
        if($amount->balance >= $out){
            $balance = $amount->balance - $out;
        }else{
            session()->flash('message', 'Failed, Insufficient balance.');
            return redirect()->back();
        }


        DB::beginTransaction();
        if($vouchers){
            foreach($vouchers as $voucher){
                $voucher->update([
                    'payment_status' => 1,
                ]);
                $refNo = $voucher->ref_no;
                $voucherNo = $voucher->voucher_no;
                PaymentLog::create([
                    'paid_by' => auth()->user()->name,
                    'payment_date' => now(),
                    'voucher_no' => $voucher->voucher_no,
                ]);
            }

            CashBook::create([
                'user_id' => auth()->id(),
                'ref_no' => $refNo,
                'voucher_no' => $voucherNo,
                'out' => $out,
                'in' => 0,
                'balance' => $balance,
            ]);
            DB::commit();
            session()->flash('message', 'Success, Voucher No.: ' .$code .' was paid successfully.');
            return redirect()->route('cash-report');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function render()
    {
        $reports = CashReport::wherevoucher_no($this->code)->get();

        return view('livewire.voucher-report', compact('reports'))->extends('layouts.master');
    }
}
