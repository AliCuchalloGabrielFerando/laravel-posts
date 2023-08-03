<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Mail\LoginCredentials;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendLoginCredentials
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
    public function handle(UserCreated $event): void
    {
      //  dd($event->user->toArray(),$event->password);
      
      Mail::to($event->user)->queue(
        new LoginCredentials($event->user,$event->password)
      );

    }
}
