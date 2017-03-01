<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mail\ResetPassword as PasswordResetMailable;

use Mail;

use App\Adtje;
use App\Quote;
use App\Buddy;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_token'
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
     * Verifies the current user
     */
    public function verify()
    {
        $this->verified = 1;
        $this->email_token = null;
        $this->save();
    }

    public function adtjes() {
        return $this->hasMany(Adtje::class);
    }

    public function quotes() {
        return $this->hasMany(Quote::class);
    }

    public function myBuddies() {
        return $this->hasMany(Buddy::class);
    }

    public function buddyOf() {
        return $this->hasMany(Buddy::class, 'buddy_id');
    }

    public function allBuddies() {
        return $this->myBuddies->merge($this->buddyOf);
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
