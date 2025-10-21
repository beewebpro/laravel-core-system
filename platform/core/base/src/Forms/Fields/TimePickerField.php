<?php

namespace Bng\Base\Forms\Fields;

use Bng\Base\Facades\Assets;
use Bng\Base\Forms\FormField;

class TimePickerField extends FormField
{
    protected function getTemplate(): string
    {
        Assets::addScripts(['timepicker'])
            ->addStyles(['timepicker']);

        return 'core/base::forms.fields.time-picker';
    }
}
