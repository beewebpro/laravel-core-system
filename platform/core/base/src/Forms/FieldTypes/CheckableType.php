<?php

namespace Bng\Base\Forms\FieldTypes;

use Bng\Base\Traits\Forms\CanSpanColumns;

class CheckableType extends \Kris\LaravelFormBuilder\Fields\CheckableType
{
    use CanSpanColumns;
}
