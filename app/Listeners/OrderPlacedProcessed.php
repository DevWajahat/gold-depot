<?php

namespace App\Listeners;

use App\Events\OrderProducts;
use App\Models\User;
use App\Notifications\OrderPlacedNotification;
use Illuminate\Support\Facades\Mail;

class OrderPlacedProcessed
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderProducts $event): void
    {

        $order = $event->order;
        // dd($order);
        User::where('role','admin')->first()->notify(new OrderPlacedNotification($order));
        // Mail::to(auth()->user()->email)->send(new SendOrderDetailsMail($order));
    }
}
