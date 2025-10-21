<?php

namespace Bng\Base\Forms\FieldTypes;

use Bng\Base\Traits\Forms\CanSpanColumns;

class RepeatedType extends \Kris\LaravelFormBuilder\Fields\RepeatedType
{
    use CanSpanColumns;
}
