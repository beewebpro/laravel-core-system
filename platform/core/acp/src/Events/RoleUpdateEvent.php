<?php

namespace Bng\Acp\Events;

use Bng\Acp\Models\Role;
use Bng\Base\Events\Event;
use Illuminate\Queue\SerializesModels;

class RoleUpdateEvent extends Event
{
    use SerializesModels;

    public function __construct(public Role $role) {}
}
