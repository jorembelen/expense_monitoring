<?php

namespace App\Http\Livewire;

use App\Models\CashBook;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CashBooksList extends Component
{
    public $amount, $voucher_no, $ref_no;


    public function add()
    {
        $this->dispatchBrowserEvent('show-wallet-form');
    }

    public function submit()
    {
        $this->validate([
            'ref_no' => 'required',
            'voucher_no' => 'required|unique:cash_books,voucher_no',
            'amount' => 'required'
        ]);

    $amount = CashBook::latest()->first();
    $balance = $amount->balance + $this->amount;

        DB::beginTransaction();
        if($amount){
            CashBook::create([
                'user_id' => auth()->id(),
                'ref_no' => $this->ref_no,
                'voucher_no' => $this->voucher_no,
                'in' => $this->amount,
                'out' => 0,
                'balance' => $balance,
            ]);
            DB::commit();
            session()->flash('message', 'Success, ' .$this->amount .' was added successfully.');
            return redirect()->route('cash-book');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
    }

    public function render()
    {
        $cash = CashBook::latest()->get();
        $amount = CashBook::latest()->first();
        $balance = $amount->balance;

        return view('livewire.cash-book', compact('cash', 'balance'))->extends('layouts.master');
    }
}
