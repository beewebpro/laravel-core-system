<?php

namespace Bng\Acp\Repositories\Interfaces;

use Bng\Support\Repositories\Interfaces\RepositoryInterface;

interface UserInterface extends RepositoryInterface
{
    public function getUniqueUsernameFromEmail(string $email): string;
}
