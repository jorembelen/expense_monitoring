<?php

namespace App\View\Components;

use App\Models\CashAdvance;
use Illuminate\View\Component;

class CashAdvanceForJob extends Component
{
    public $totalCafj;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($totalCafj)
    {
        $this->totalCafj = CashAdvance::whereapproval_status(0)->pluck('id')->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cash-advance-for-job');
    }
}
