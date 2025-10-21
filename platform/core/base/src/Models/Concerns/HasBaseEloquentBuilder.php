<?php

namespace Bng\Base\Models\Concerns;

use Bng\Base\Models\BaseQueryBuilder;

trait HasBaseEloquentBuilder
{
    public function newEloquentBuilder($query): BaseQueryBuilder
    {
        return new BaseQueryBuilder($query);
    }
}
