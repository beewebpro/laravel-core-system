<?php

namespace Bng\Table\Columns;

use BackedEnum;
use Bng\Base\Facades\BaseHelper;
use Bng\Base\Supports\Enum;
use Bng\Table\Contracts\FormattedColumn as FormattedColumnContract;

class EnumColumn extends FormattedColumn implements FormattedColumnContract
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data, $name)
            ->alignCenter()
            ->width(100)
            ->renderUsing(function (EnumColumn $column, $value) {
                return $column->formattedValue($value);
            });
    }

    public function formattedValue($value): string
    {
        if (! $value instanceof Enum && ! $value instanceof BackedEnum) {
            return '';
        }

        if ($value instanceof BackedEnum) {
            return $value->value;
        }

        $table = $this->getTable();

        if ($table->isExportingToExcel() || $table->isExportingToCSV()) {
            return $value->getValue();
        }

        $value = $value->toHtml() ?: $value->getValue();

        return BaseHelper::clean($value);
    }
}
