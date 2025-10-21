<?php

namespace Bng\Base\Forms\FieldTypes;

use Bng\Base\Traits\Forms\CanSpanColumns;

class SelectType extends \Kris\LaravelFormBuilder\Fields\SelectType
{
    use CanSpanColumns;
}
