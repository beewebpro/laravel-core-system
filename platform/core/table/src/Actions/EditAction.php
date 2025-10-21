<?php

namespace Bng\Table\Actions;

class EditAction extends Action
{
    public static function make(string $name = 'edit'): static
    {
        return parent::make($name)->color('info')->icon('bx bx-edit');
    }
}
