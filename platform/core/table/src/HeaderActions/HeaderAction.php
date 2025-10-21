<?php

namespace Bng\Table\HeaderActions;

use Bng\Base\Supports\Builders\HasAttributes;
use Bng\Base\Supports\Builders\HasColor;
use Bng\Base\Supports\Builders\HasIcon;
use Bng\Base\Supports\Builders\HasLabel;
use Bng\Base\Supports\Builders\HasPermissions;
use Bng\Base\Supports\Builders\HasUrl;
use Illuminate\Contracts\Support\Arrayable;

class HeaderAction implements Arrayable
{
    use HasLabel;
    use HasColor;
    use HasIcon;
    use HasUrl;
    use HasPermissions;
    use HasAttributes;

    public function __construct(protected string $name) {}

    public static function make(string $name): static
    {
        return app(static::class, ['name' => $name]);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function toArray(): array
    {
        return [
            'className' => sprintf('action-item %s %s', $this->getColor(), $this->getAttribute('class')),
            'text' => view('core/table::includes.header-action', ['action' => $this])->render(),
        ];
    }

    public function route(string $route, array $parameters = [], bool $absolute = true): static
    {
        $this
            ->url(fn(HeaderAction $action) => route($route, $parameters, $absolute))
            ->permission($route);

        return $this;
    }
}
