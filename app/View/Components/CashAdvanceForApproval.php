<?php

namespace App\View\Components;

use App\Models\CashAdvance;
use Illuminate\View\Component;

class CashAdvanceForApproval extends Component
{
    public $totalCA;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($totalCA)
    {
        $this->totalCA = CashAdvance::whereapproval_status(1)->pluck('id')->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cash-advance-for-approval');
    }
}
