<?php

namespace Bng\Table\Columns;

use Bng\Base\Facades\Html;
use Bng\Table\Columns\Concerns\HasLink;
use Bng\Table\Contracts\FormattedColumn as FormattedColumnContract;

class EmailColumn extends FormattedColumn implements FormattedColumnContract
{
    use HasLink;

    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'email', $name)
            ->title(trans('core/base::tables.email'))
            ->alignStart();
    }

    public function formattedValue($value): string|null
    {
        if (! $this->isLinkable() || ! $value) {
            return null;
        }

        return Html::mailto($value, $value);
    }
}
