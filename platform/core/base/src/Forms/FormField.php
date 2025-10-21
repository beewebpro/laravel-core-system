<?php

namespace Bng\Base\Forms;

use Bng\Base\Traits\Forms\CanSpanColumns;
use Kris\LaravelFormBuilder\Fields\FormField as BaseFormField;

abstract class FormField extends BaseFormField
{
    use CanSpanColumns;
}
