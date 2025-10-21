<?php

namespace Bng\Table\Contracts;

use Bng\Base\Contracts\BaseModel;
use Bng\Table\Abstracts\TableAbstract;

interface FormattedColumn
{
    public function formattedValue($value): string|null;

    public function renderCell(BaseModel|array $item, TableAbstract $table): string;
}
