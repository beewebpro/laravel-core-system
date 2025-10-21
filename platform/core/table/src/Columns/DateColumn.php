<?php

namespace Bng\Table\Columns;

use Bng\Base\Facades\BaseHelper;
use Bng\Table\Contracts\FormattedColumn as FormattedColumnContract;

class DateColumn extends FormattedColumn implements FormattedColumnContract
{
    protected string $dateFormat;

    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data, $name)
            ->type('date')
            ->width(100)
            ->withEmptyState();
    }

    public function dateFormat(string $format): static
    {
        $this->dateFormat = $format;

        return $this;
    }

    public function formattedValue($value): string
    {
        if (! $value) {
            return '';
        }

        return BaseHelper::formatDate($value, $this->dateFormat ?? BaseHelper::getDateFormat());
    }
}
