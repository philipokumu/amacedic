<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EditorResetPasswordNotification;

class Editor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'editor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'nickname','accountType','accountName',
        'accountNumber','country','bio','educationLevel','bankName','profilePhoto','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function subjectAreas(){
        return $this->hasMany(SubjectArea::class);
    }
        /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EditorResetPasswordNotification($token));
    }
}
