<?php

namespace Bng\Table\Actions;

class DeleteAction extends Action
{
    public static function make(string $name = 'delete'): static
    {
        return parent::make($name)
            ->color('danger')
            ->icon('bx bx-trash')
            ->action('DELETE')
            ->confirmation();
    }
}
