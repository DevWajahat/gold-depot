<?php

namespace App\Listeners;

use App\Events\PasswordReset;
use App\Mail\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetLink
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(PasswordReset $event): void
    {
        // dd($event);

        Mail::to($event->record->email)->send(new ResetPassword($event->record));
    }
}
