<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nationality',
        'position',
        'type',
        'user_code',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function ($employee){
            $employee->user_code = (string) rand(1,1000000);
        });
    }



    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
        ->where('name', 'like', '%'.$search.'%')
        ->orWhere('user_code', 'like', '%'.$search.'%')
        ->orWhere('type', 'like', '%'.$search.'%')
        ->orWhere('nationality', 'like', '%'.$search.'%')
        ->orWhere('position', 'like', '%'.$search.'%');
    }

}
