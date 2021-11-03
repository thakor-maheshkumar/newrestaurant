<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Mail;
use App\Mail\SendMail;
class NotifyPostCreated
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
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $users=User::all();
        //dd($user);
        foreach($users as $user){
            //Mail::to($user)->send('emails.multiple', $event->foodchef);
            Mail::to('am@gmail.com')->send(new SendMail($event->foodchef));
        }
    }
}
