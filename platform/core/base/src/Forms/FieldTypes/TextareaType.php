<?php

namespace Bng\Base\Forms\FieldTypes;

use Bng\Base\Traits\Forms\CanSpanColumns;

class TextareaType extends \Kris\LaravelFormBuilder\Fields\TextareaType
{
    use CanSpanColumns;
}
