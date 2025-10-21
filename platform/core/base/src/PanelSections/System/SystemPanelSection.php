<?php

namespace Bng\Base\PanelSections\System;

use Bng\Base\PanelSections\PanelSection;
use Bng\Base\PanelSections\PanelSectionItem;

class SystemPanelSection extends PanelSection
{
    public function setup(): void
    {
        $this
            ->setId('system')
            ->setTitle(trans('core/base::layouts.platform_admin'))
            ->withPriority(99999)
            ->withItems([]);
    }
}
