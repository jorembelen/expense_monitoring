<?php

namespace App\Http\Livewire;

use App\Models\CashReport;
use Livewire\Component;

class UnpaidCashReport extends Component
{
    public $query;

    public function render()
    {
        $reports = CashReport::search($this->query)
        ->whereapproval_status(0)
        ->wherepayment_status(0)
        ->latest()
        ->get();

        $reports = $reports->groupBy('voucher_no');

        return view('livewire.unpaid-cash-report', compact('reports'))->extends('layouts.master');
    }
}
