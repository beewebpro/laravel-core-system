<?php

namespace Bng\Base\Forms\Fields;

use Bng\Base\Facades\Assets;
use Bng\Base\Forms\FormField;

class MediaImagesField extends FormField
{
    protected function getTemplate(): string
    {
        Assets::addScripts(['jquery-ui']);

        return 'core/base::forms.fields.media-images';
    }
}
