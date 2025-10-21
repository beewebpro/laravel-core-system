<?php

namespace Bng\Base\Traits\Forms;

use Bng\Base\Forms\FormCollapse;

trait HasCollapsible
{
    public function addCollapsible(FormCollapse $form): static
    {
        $form->build($this);

        return $this;
    }
}
