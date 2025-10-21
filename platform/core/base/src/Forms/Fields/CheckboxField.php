<?php

namespace Bng\Base\Forms\Fields;

use Bng\Base\Forms\FieldTypes\CheckableType;

class CheckboxField extends CheckableType
{
    protected function getTemplate(): string
    {
        return 'core/base::forms.fields.checkbox';
    }
}
