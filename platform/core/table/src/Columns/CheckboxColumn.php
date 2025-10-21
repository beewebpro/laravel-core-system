<?php

namespace Bng\Table\Columns;

use Bng\Base\Contracts\BaseModel;
use Bng\Base\Facades\Form;
use Bng\Table\Contracts\FormattedColumn as FormattedColumnContract;

class CheckboxColumn extends FormattedColumn implements FormattedColumnContract
{
    public static function make(array|string $data = [], string $name = ''): static
    {
        return parent::make($data ?: 'checkbox', $name)
            ->content('')
            ->title(
                view('core/table::partials.checkbox-all')->render()
            )
            ->className('w-1')
            ->width(50)
            ->alignStart()
            ->orderable(false)
            ->exportable(false)
            ->searchable(false)
            ->columnVisibility()
            ->titleAttr(trans('core/base::tables.checkbox'));
    }

    public function formattedValue($value): string
    {
        $item = $this->getItem();

        return view('core/table::partials.checkbox', [
            'id' => $item instanceof BaseModel ? $item->getKey() : null,
        ])->render();
    }
}
