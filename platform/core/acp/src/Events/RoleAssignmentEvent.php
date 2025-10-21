<?php

namespace Bng\Acp\Events;

use Bng\Acp\Models\Role;
use Bng\Acp\Models\User;
use Bng\Base\Events\Event;
use Illuminate\Queue\SerializesModels;

class RoleAssignmentEvent extends Event
{
    use SerializesModels;

    public function __construct(public Role $role, public User $user) {}
}
