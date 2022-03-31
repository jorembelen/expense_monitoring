<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'approved_by',
        'cash_advance_id',
        'voucher_no',
        'approval_date',
    ];

     public function ca()
    {
        return $this->belongsTo(CashAdvance::class);
    }


}
