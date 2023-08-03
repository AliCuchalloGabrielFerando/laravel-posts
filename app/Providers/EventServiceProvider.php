<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\UserCreated;
use App\Listeners\SendLoginCredentials;
use Illuminate\Support\Facades\Event;
use App\Models\Photo;
use App\Models\Post;
use App\Observers\PhotoObserver;
use App\Observers\PostObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserCreated::class=>[
            SendLoginCredentials::class
        ]
    ];
    protected $observers = [
        Photo::class =>[PhotoObserver::class],
        Post::class =>[PostObserver::class],
    ];
   
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
