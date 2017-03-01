<?php

namespace App\Listeners;

use App\Mail\EmailVerification;
use Illuminate\Auth\Events\Registered;
use Mail;

class UserListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Mail::to($event->user)->send(new EmailVerification($event->user));
    }
}
