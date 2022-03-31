<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavbarComponent extends Component
{
    public function render()
    {
        $notifications = auth()->user()->unreadNotifications()->take(5)->latest()->get();

        return view('livewire.navbar-component', compact('notifications'));
    }
}
