<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\OrderWasPlaced;
use App\Listeners\ReactOnOrderWasPlaced;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        OrderWasPlaced::class => [
            ReactOnOrderWasPlaced::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}