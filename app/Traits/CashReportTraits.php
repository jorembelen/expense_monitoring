<?php

namespace App\Traits;

use App\Models\CashReport;

trait CashReportTraits
{
    public function totalLiquidated()
    {
            $amount = CashReport::wherecash_advance_id($this->id)->wherepayment_status(1)->sum('sar');
            if($amount){
                return $amount;
            }
            return 0;
    }



}
