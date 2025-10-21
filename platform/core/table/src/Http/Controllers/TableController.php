<?php

namespace Bng\Table\Http\Controllers;

use Bng\Base\Http\Controllers\BaseController;
use Bng\Table\TableBuilder;

class TableController extends BaseController
{
    public function __construct(protected TableBuilder $tableBuilder) {}
}
