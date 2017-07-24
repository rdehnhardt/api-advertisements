<?php

namespace App\Listeners;

use App\Notifications\WelcomeMessage;
use Illuminate\Auth\Events\Registered;

class SendWelcomeMessage
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $event->user->notify(new WelcomeMessage($event->user));
    }
}
