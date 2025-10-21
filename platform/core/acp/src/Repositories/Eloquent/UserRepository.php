<?php

namespace Bng\Acp\Repositories\Eloquent;

use Bng\Acp\Repositories\Interfaces\UserInterface;
use Bng\Support\Repositories\Eloquent\RepositoriesAbstract;

class UserRepository extends RepositoriesAbstract implements UserInterface
{
    public function getUniqueUsernameFromEmail(string $email): string
    {
        $emailPrefix = substr($email, 0, strpos($email, '@'));
        $username = $emailPrefix;
        $offset = 1;
        while ($this->getFirstBy(['username' => $username])) {
            $username = $emailPrefix . $offset;
            $offset++;
        }

        $this->resetModel();

        return $username;
    }
}
