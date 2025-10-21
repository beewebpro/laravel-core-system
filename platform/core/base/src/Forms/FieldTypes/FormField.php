<?php

namespace Bng\Base\Forms\FieldTypes;

use Bng\Base\Traits\Forms\CanSpanColumns;

abstract class FormField extends \Kris\LaravelFormBuilder\Fields\FormField
{
    use CanSpanColumns;
}
