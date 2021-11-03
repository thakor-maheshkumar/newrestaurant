<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
       
        'App\Events\LoginHistory' => [
            'App\Listeners\StoreUserLoginHistory',
        ],
         'App\Events\PostCreated' => [
            'App\Listeners\NotifyPostCreated',
        ],
        'App\Events\FoodEvent'=>[
            'App\Listeners\FoodListener',
        ],
        'App\Events\MultipleEvent'=>[
            'App\Listeners\MultipleListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
