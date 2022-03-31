<?php

namespace App\View\Components;

use App\Models\CashReport;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class CashReportForVoucher extends Component
{
    public $totalCrfv;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($totalCrfv)
    {
        // $this->totalCrfv = CashReport::whereapproval_status(0)->pluck('id')->count();
        $data = DB::table('cash_reports')
        ->select('voucher_no')
        ->whereapproval_status(0)
        ->groupBy('voucher_no')
        ->get();

        $this->totalCrfv = $data->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cash-report-for-voucher');
    }
}
