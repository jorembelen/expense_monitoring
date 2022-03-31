<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    public $password, $password_confirmation;

    public function submit()
    {
        $this->validate([
            'password' => 'required|min:6|confirmed'
        ]);

        if(Hash::check($this->password, auth()->user()->password)){
            session()->flash('message', 'Failed, Do not use the old password!');
            $this->password = null;
            $this->password_confirmation = null;
            return redirect()->back();
        }
        $user = User::find(auth()->id());
        $user->update(['password' => $this->password]);
        return redirect()->route('home');

    }

    public function render()
    {
        return view('livewire.reset-password')->extends('reset-pw');
    }
}
