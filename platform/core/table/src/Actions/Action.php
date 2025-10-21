<?php

namespace Bng\Table\Actions;

use Bng\Base\Supports\Builders\HasAttributes;
use Bng\Base\Supports\Builders\HasColor;
use Bng\Base\Supports\Builders\HasIcon;
use Bng\Base\Supports\Builders\HasUrl;
use Bng\Table\Abstracts\TableActionAbstract;
use Bng\Table\Actions\Concerns\HasAction;

class Action extends TableActionAbstract
{
    use HasAction;
    use HasAttributes;
    use HasColor;
    use HasIcon;
    use HasUrl;
}
