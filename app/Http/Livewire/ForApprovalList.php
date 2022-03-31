<?php

namespace App\Http\Livewire;

use App\Models\CashReport;
use Livewire\Component;

class ForApprovalList extends Component
{
    public $query;

    public function render()
    {
        $reports = CashReport::search($this->query)
        ->whereapproval_status(1)
        ->wherepayment_status(0)
        ->latest()
        ->get();

        $reports = $reports->groupBy('voucher_no');

        return view('livewire.for-approval-list', compact('reports'))->extends('layouts.master');
    }
}
