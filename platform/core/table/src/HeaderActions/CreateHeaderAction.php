<?php

namespace Bng\Table\HeaderActions;

class CreateHeaderAction extends HeaderAction
{
    public static function make(string $name = 'create'): static
    {
        return parent::make($name)
            ->icon('bx bx-plus font-size-16 align-middle me-2')
            ->label(trans('core/base::base.forms.create'))
            ->color('info');
    }
}
