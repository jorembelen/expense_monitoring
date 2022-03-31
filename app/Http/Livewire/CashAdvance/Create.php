<?php

namespace App\Http\Livewire\CashAdvance;

use App\Models\CashAdvance;
use App\Models\User;
use App\Notifications\CashAdvanceNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Create extends Component
{
    public $purpose, $amount;

    public function add()
    {
        $this->dispatchBrowserEvent('show-ca-form');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
    }

    public function submit()
    {
        $this->validate([
            'purpose' => 'required',
            'amount' => 'required'
        ]);

        $ca = new CashAdvance();
        $email = User::whererole_id(1)->get();

        DB::beginTransaction();
        if($ca){
            $ca->create([
                'user_id' => auth()->id(),
                'amount' => $this->amount,
                'purpose' => $this->purpose,
            ]);
            DB::commit();

            $details = [
                'title' => 'New Cash Advance',
                'data' => 'New Cash Advance was submitted by ' .auth()->user()->name,
                'url' => route('cash-advance'),
            ];

            Notification::send($email, new CashAdvanceNotification($details));

            session()->flash('message', 'Success, ' .$this->amount .' was requested successfully.');
            return redirect()->route('ca.create');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function render()
    {
        $advances = CashAdvance::whereuser_id(auth()->id())->latest()->get();

        return view('livewire.cash-advance.create', compact('advances'))->extends('layouts.master');
    }
}
