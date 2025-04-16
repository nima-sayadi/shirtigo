<?php

namespace App\Listeners;

use App\Events\OrderWasPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use App\Jobs\BookOrderInAccounting;
use Illuminate\Queue\InteractsWithQueue;

class ReactOnOrderWasPlaced
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
    public function handle(OrderWasPlaced $event): void
    {
        Log::info("Order was placed {$event->order['reference']}");

        BookOrderInAccounting::dispatch($event->order);
    }
}
