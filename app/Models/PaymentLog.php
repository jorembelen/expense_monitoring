<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;


    protected $fillable = [
        'paid_by',
        'cash_advance_id',
        'voucher_no',
        'payment_date',
    ];

}
