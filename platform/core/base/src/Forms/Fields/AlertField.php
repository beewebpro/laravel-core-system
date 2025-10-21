<?php

namespace Bng\Base\Forms\Fields;

use Bng\Base\Forms\FormField;

class AlertField extends FormField
{
    protected function getTemplate(): string
    {
        return 'core/base::forms.fields.alert';
    }
}
