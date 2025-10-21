<?php

namespace Bng\Acp\Listeners;

use Bng\Acp\Events\RoleAssignmentEvent;

class RoleAssignmentListener
{
    public function handle(RoleAssignmentEvent $event): void
    {
        $permissions = $event->role->permissions;
        $permissions['superuser'] = $event->user->super_user;
        $permissions['manage_supers'] = $event->user->manage_supers;

        $event->user->permissions = $permissions;
        $event->user->save();
    }
}
