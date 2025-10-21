<?php

namespace Bng\Base\Forms\Fields;

use Bng\Base\Forms\FormField;

class ColorField extends FormField
{
    protected function getTemplate(): string
    {
        return 'core/base::forms.fields.color';
    }
}
