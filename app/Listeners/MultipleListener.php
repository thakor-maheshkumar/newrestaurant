<?php

namespace App\Listeners;
use App\Events\MultipleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\MultipleSingle;
class MultipleListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(MultipleEvent $event)
    {
        return Mail::to('mahesh@g.com')->send(new MultipleSingle($event->multipleProduct));
    }
}
