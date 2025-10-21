<?php

namespace Bng\Acp\Tables;

use Bng\Acp\Enums\UserStatusEnum;
use Bng\Acp\Models\User;
use Bng\Table\Abstracts\TableAbstract;
use Bng\Table\Actions\Action;
use Bng\Table\Actions\DeleteAction;
use Bng\Table\Actions\EditAction;
use Bng\Table\BulkChanges\EmailBulkChange;
use Bng\Table\BulkChanges\NameBulkChange;
use Bng\Table\BulkChanges\StatusBulkChange;
use Bng\Table\Columns\Column;
use Bng\Table\Columns\CreatedAtColumn;
use Bng\Table\Columns\EmailColumn;
use Bng\Table\Columns\LinkableColumn;
use Bng\Table\Columns\NameColumn;
use Bng\Table\Columns\YesNoColumn;
use Bng\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserTable extends TableAbstract
{
  public function setup(): void
  {
    $this->model(User::class)
      ->addColumns([
        NameColumn::make()->route('users.edit'),
        LinkableColumn::make('username')->route('users.edit'),
        EmailColumn::make(),
        YesNoColumn::make('super_user')
          ->title(trans('core/acp::user.is_super'))
          ->width(100),
        CreatedAtColumn::make()->dateFormat('d-m-Y'),
      ])
      ->when(Auth::guard()->user()->isSuperUser(), function () {
        $this->addActions([
          Action::make('make-super')
            ->route('users.make-super')
            ->color('success')
            ->label(trans('core/acp::user.make_super'))
            ->renderUsing(fn(Action $action) => $action->getItem()->isSuperUser() ? '' : null),
          Action::make('remove-super')
            ->route('users.remove-super')
            ->label(trans('core/acp::user.remove_super'))
            ->color('warning')
            ->renderUsing(fn(Action $action) => ! $action->getItem()->isSuperUser() ? '' : null),
        ]);
      })
      ->addActions([
        EditAction::make()->route('users.edit'),
        DeleteAction::make()->route('users.destroy')
      ])
      ->addHeaderAction(CreateHeaderAction::make()->route('users.create'))
      ->addBulkChanges([
        NameBulkChange::make()
          ->name('username')
          ->title(trans('core/acp::user.username')),
        EmailBulkChange::make(),
        StatusBulkChange::make()
          ->choices(UserStatusEnum::labels())
          ->validate(['required', Rule::in(UserStatusEnum::values())]),
      ])
      ->queryUsing(function (Builder $query) {
        return $query
          ->select([
            'id',
            'name',
            'username',
            'email',
            'updated_at',
            'created_at',
            'super_user',
          ]);
      });
  }

  public function htmlDrawCallbackFunction(): string|null
  {
    return parent::htmlDrawCallbackFunction();
  }
}
