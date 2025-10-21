<?php

namespace Bng\Base\Events;

use Bng\Base\Contracts\PanelSections\Manager;
use Illuminate\Foundation\Events\Dispatchable;

class PanelSectionsRendering
{
    use Dispatchable;

    public function __construct(public Manager $panelSectionManager) {}
}
