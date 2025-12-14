<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\SeriesCreated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SeriesCreated as eventSeriesCreated;

class EmailUserAboutSeriesCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(eventSeriesCreated $event): void
    {
        foreach(User::all() as $index => $user){
            $seriesMail = new SeriesCreated($event->name, $event->season, $event->episode, $event->id);

            $when = now()->addSeconds($index * 3);
            Mail::to($user)->later($when, $seriesMail);
        }
    }
}
