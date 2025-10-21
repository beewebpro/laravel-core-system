<?php

namespace Bng\Acp\Tables;

use Bng\Acp\Models\Role;
use Bng\Base\Facades\BaseHelper;
use Bng\Table\Abstracts\TableAbstract;
use Bng\Table\Actions\DeleteAction;
use Bng\Table\Actions\EditAction;
use Bng\Table\BulkActions\DeleteBulkAction;
use Bng\Table\BulkChanges\NameBulkChange;
use Bng\Table\Columns\CreatedAtColumn;
use Bng\Table\Columns\FormattedColumn;
use Bng\Table\Columns\IdColumn;
use Bng\Table\Columns\LinkableColumn;
use Bng\Table\Columns\NameColumn;
use Bng\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class RoleTable extends TableAbstract
{
  public function setup(): void
  {
    $this
      ->model(Role::class)
      ->addColumns([
        IdColumn::make(),
        NameColumn::make()->route('roles.edit'),
        FormattedColumn::make('description')
          ->title(trans('core/base::tables.description'))
          ->alignStart()
          ->withEmptyState(),
        CreatedAtColumn::make(),
        LinkableColumn::make('created_by')
          ->urlUsing(fn(LinkableColumn $column) => $column->getItem()->author->url)
          ->title(trans('core/acp::role.created_by'))
          ->width(100)
          ->getValueUsing(function (LinkableColumn $column) {
            return BaseHelper::clean($column->getItem()->author->name);
          })
          ->externalLink()
          ->withEmptyState(),
      ])
      ->addHeaderAction(CreateHeaderAction::make()->route('roles.create'))
      ->addActions([
        EditAction::make()->route('roles.edit'),
        DeleteAction::make()->route('roles.destroy'),
      ])
      ->addBulkAction(DeleteBulkAction::make()->permission('roles.destroy'))
      ->addBulkChange(NameBulkChange::make())
      ->queryUsing(function (Builder $query): void {
        $query
          ->with('author')
          ->select([
            'id',
            'name',
            'description',
            'created_at',
            'created_by',
          ]);
      });
  }
}
