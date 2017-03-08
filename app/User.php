<?php

namespace App;

use App\Mail\ResetPassword as PasswordResetMailable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_token',
    ];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Verifies the current user.
     */
    public function verify()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }

    public function adtjes()
    {
        return $this->hasMany(Adtje::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }

    public function buddies()
    {
        return $this->hasMany(Buddy::class)->get()->merge($this->hasMany(Buddy::class, 'buddy_id')->get());
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new PasswordResetMailable($this, $token));
    }
}
