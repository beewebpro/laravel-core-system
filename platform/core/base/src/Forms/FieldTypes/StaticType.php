<?php

namespace Bng\Base\Forms\FieldTypes;

use Bng\Base\Traits\Forms\CanSpanColumns;

class StaticType extends \Kris\LaravelFormBuilder\Fields\StaticType
{
    use CanSpanColumns;
}
