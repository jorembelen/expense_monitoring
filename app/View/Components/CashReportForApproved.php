<?php

namespace App\View\Components;

use App\Models\CashReport;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class CashReportForApproved extends Component
{
    public $totalCra;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($totalCra)
    {
        // $this->totalCra = CashReport::whereapproval_status(2)->wherepayment_status(0)->pluck('id')->count();
        $data = DB::table('cash_reports')
        ->select('voucher_no')
        ->whereapproval_status(2)
        ->wherepayment_status(0)
        ->groupBy('voucher_no')
        ->get();

        $this->totalCra = $data->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cash-report-for-approved');
    }
}
