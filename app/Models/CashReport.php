<?php

namespace App\Models;

use App\Traits\CashReportTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashReport extends Model
{
    use HasFactory, CashReportTraits;

    protected $dates = ['invoice_date'];

    protected $fillable = [
        'user_id',
        'cash_advance_id',
        'gl_code_id',
        'employee_id',
        'ref_no',
        'voucher_no',
        'description',
        'sar',
        'invoice_date',
        'job_no',
        'batch_code',
        'approval_status',
        'payment_status',
        'approval_date',
        'payment_date',
        'type',
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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function code()
    {
        return $this->belongsTo(GlCode::class, 'gl_code_id');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
        ->where('batch_code', 'like', '%'.$search.'%')
        ->orWhere('job_no', 'like', '%'.$search.'%');
    }

}
