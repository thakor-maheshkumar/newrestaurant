<?php

namespace App\Listeners;

use App\Events\FoodEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\FoodEmail;
use Auth;
class FoodListener
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
     * @param  FooEvent  $event
     * @return void
     */
    public function handle(FoodEvent $event)
    {
        $user=Auth::user();
        Mail::to($user)->send(new FoodEmail($event->food));
    }
}
