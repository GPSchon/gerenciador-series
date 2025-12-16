<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SeriesCreated as eventSeriesCreated;

class LogListnerCreate
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
    public function handle(eventSeriesCreated $event): void
    {
        Log::info("A série {$event->name} foi adicionada com sucesso");
    }
}
