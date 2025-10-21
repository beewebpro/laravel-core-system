<?php

namespace Bng\Acp\Listeners;

use Bng\Acp\Models\User;
use Illuminate\Auth\Events\Login;

class LoginListener
{
    public function handle(Login $event): void
    {
        if (! $event->user instanceof User) {
            return;
        }
    }
}
