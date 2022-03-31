<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_code',
        'account_description',
        'access'
    ];

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
        ->where('account_code', 'like', '%'.$search.'%')
        ->orWhere('account_description', 'like', '%'.$search.'%');
    }

}

