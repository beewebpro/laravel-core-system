<?php

namespace Bng\Acp\Repositories\Interfaces;

use Bng\Support\Repositories\Interfaces\RepositoryInterface;

interface RoleInterface extends RepositoryInterface
{
    public function createSlug(string $name, int|string $id): string;
}
