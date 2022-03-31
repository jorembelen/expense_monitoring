<?php

namespace App\View\Components;

use App\Models\ApprovalLog;
use App\Models\CashReport;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class CashReportForApproval extends Component
{
    public $total;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($total)
    {
        $data = DB::table('cash_reports')
        ->select('voucher_no')
        ->whereapproval_status(1)
        ->groupBy('voucher_no')
        ->get();

        $this->total = $data->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cash-report-for-approval');
    }
}
