<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ref_no',
        'voucher_no',
        'in',
        'out',
        'balance',
    ];

}
