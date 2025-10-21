<?php

namespace Bng\Base\Forms\Fields;

use Bng\Base\Forms\FieldTypes\SelectType;

class UiSelectorField extends SelectType
{
    protected function getTemplate(): string
    {
        return 'core/base::forms.fields.ui-selector';
    }
}
