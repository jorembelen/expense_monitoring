<?php

namespace App\Models;

use App\Traits\CashReportTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{
    use HasFactory, CashReportTraits;

    protected $dates = ['approval_date'];

    protected $fillable = [
        'user_id',
        'job_no',
        'amount',
        'purpose',
        'approval_date',
        'approval_status',
        'payment_status',
    ];

    public function approval()
    {
        return $this->hasMany(ApprovalLog::class);
    }

    public function payment()
    {
        return $this->hasMany(PaymentLog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
