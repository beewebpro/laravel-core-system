<?php

namespace Bng\Base\Forms\FieldTypes;

use Bng\Base\Traits\Forms\CanSpanColumns;

class CollectionType extends \Kris\LaravelFormBuilder\Fields\CollectionType
{
    use CanSpanColumns;
}
