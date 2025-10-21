<?php

namespace Bng\Acp\Listeners;

use Bng\Acp\Events\RoleUpdateEvent;

class RoleUpdateListener
{
    public function handle(RoleUpdateEvent $event): void
    {
        $permissions = $event->role->permissions;
        foreach ($event->role->users()->get() as $user) {
            $permissions['superuser'] = $user->super_user;
            $permissions['manage_supers'] = $user->manage_supers;

            $user->permissions = $permissions;
            $user->save();
        }
    }
}
