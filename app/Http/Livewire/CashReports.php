<?php

namespace App\Http\Livewire;

use App\Models\CashReport;
use Livewire\Component;
use Livewire\WithPagination;

class CashReports extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $query;

    public function render()
    {
        $reports = CashReport::search($this->query)
        ->whereapproval_status(1)
        ->orWhere('approval_status', 2)
        ->latest()
        ->get();

        $reports = $reports->groupBy('voucher_no');

        return view('livewire.cash-reports', compact('reports'))->extends('layouts.master');
    }
}
