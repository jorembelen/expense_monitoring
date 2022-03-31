<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'role_id',
        'user_code',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->setId();

        });
    }

    public function setId()
    {
        $this->attributes['id'] = Str::uuid();
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function userGreetings()
    {
        $greetings = "";
        $hour = date('H');
        if ($hour >= 18) {
           $greetings = "Good Evening";
        } elseif ($hour >= 12) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
           $greetings = "Good Morning";
        }

        return $greetings .', Welcome Back';
    }

    public function role()
    {
        if($this->role_id == 1){
            return 'Administrator';
        }elseif($this->role_id == 2){
                return 'Supervisor';
        }elseif($this->role_id == 3){
                return 'Manager';
        }
    }


}
