<?php

namespace App\Observer;

use App\Models\User;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     */
    public function creating(User $user)
    {
        $user->password = bcrypt($user->password);
        $user->api_token = str_random(60);
    }
}
