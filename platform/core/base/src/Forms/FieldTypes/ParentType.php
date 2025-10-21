<?php

namespace Bng\Base\Forms\FieldTypes;

use Bng\Base\Traits\Forms\CanSpanColumns;

abstract class ParentType extends \Kris\LaravelFormBuilder\Fields\ParentType
{
    use CanSpanColumns;
}
