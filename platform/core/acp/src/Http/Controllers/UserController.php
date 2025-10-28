<?php

namespace Bng\Acp\Http\Controllers;

use Bng\Acp\Forms\ChangePasswordForm;
use Bng\Acp\Forms\EditForm;
use Bng\Acp\Forms\UserForm;
use Bng\Acp\Http\Requests\CreateUserRequest;
use Bng\Acp\Http\Requests\UpdatePasswordRequest;
use Bng\Acp\Http\Requests\UpdateUserRequest;
use Bng\Acp\Models\User;
use Bng\Acp\Services\CreateUserService;
use Bng\Acp\Services\UpdatePasswordService;
use Bng\Acp\Tables\UserTable;
use Bng\Base\Http\Actions\DeleteResourceAction;
use Bng\Base\Http\Controllers\BaseSystemController;
use Bng\Base\Supports\Breadcrumb;
use Exception;
use Illuminate\Http\Request;
use Throwable;

class UserController extends BaseSystemController
{
  protected function breadcrumb(): Breadcrumb
  {
    return parent::breadcrumb()
      ->add(
        trans('core/acp::user.users'),
        route('users.index')
      );
  }

  public function index(UserTable $dataTable)
  {
    $this->pageTitle(trans('core/acp::user.users'));
    return $dataTable->renderTable();
  }

  public function create()
  {
    $this->pageTitle(trans('core/acp::user.create_new_user'));

    return UserForm::create()->renderForm();
  }

  public function store(CreateUserRequest $request, CreateUserService $service)
  {
    $form = UserForm::create();
    $user = null;
    $form->saving(function (UserForm $form) use ($service, $request, &$user) {
      $user = $service->execute($request);

      $form->setupModel($user);
    });
    return $this
      ->httpResponse()
      ->setPreviousRoute('users.index')
      ->setNextUrl(route('users.edit', $user))
      ->withCreatedSuccessMessage();
  }

  public function edit(User $user, Request $request)
  {
    $this->pageTitle($user->name);

    $request->route()->setParameter('id', $user->getKey());
    $currentUser = $request->user();
    $canChangeProfile = $currentUser->hasPermission('users.edit') || $currentUser->getKey() == $user->getKey() || $currentUser->isSuperUser();

    $profileForm = EditForm::createFromModel($user)->setUrl(route('users.update-profile', $user->getKey()))->renderForm();

    $user->password = null;
    $changePasswordForm = ChangePasswordForm::createFromModel($user)->setUrl(route('users.update-password', $user->getKey()))->renderForm();
    if (! $canChangeProfile) {
    }

    return view(
      'core/acp::users.edit',
      compact('user', 'profileForm', 'changePasswordForm', 'canChangeProfile')
    );
  }

  public function updateProfile(User $user, UpdateUserRequest $request)
  {
    if ($request->input('status') === 'deactivated') {
      $user->activations()->update(['completed' => false, 'completed_at' => null]);
    } elseif ($request->input('status') === 'activated' && ! $user->activations()->where('completed', true)->exists()) {
      $user->activations()->create([
        'code' => md5(uniqid(mt_rand(), true)),
        'completed' => true,
        'completed_at' => now(),
      ]);
    }
    EditForm::createFromModel($user)
      ->setRequest($request)
      ->save();

    return $this
      ->httpResponse()
      ->setMessage(trans('core/acp::user.update_profile_success'));
  }

  public function updatePassword(User $user, UpdatePasswordRequest $request, UpdatePasswordService $service)
  {
    $request->merge(['id' => $user->getKey()]);
    try {
      ChangePasswordForm::createFromModel($user)
        ->saving(function (ChangePasswordForm $form) use ($service, $request) {
          return tap($service->execute($request), fn($user) => $form->setupModel($user));
        });
    } catch (Throwable $exception) {
      return $this
        ->httpResponse()
        ->setError()
        ->setMessage($exception->getMessage());
    }

    return $this
      ->httpResponse()
      ->setMessage(trans('core/acp::user.password_update_success'));
  }

  public function destroy(User $user)
  {
    return DeleteResourceAction::make($user)
      ->beforeDeleting(function (DeleteResourceAction $action) {
        $request = $action->getRequest();
        $model = $action->getModel();

        if ($request->user()->is($model)) {
          throw new Exception(trans('core/acp::user.delete_user_logged_in'));
        }

        if (! $request->user()->isSuperUser() && $model instanceof User && $model->isSuperUser()) {
          throw new Exception(trans('core/acp::user.cannot_delete_super_user'));
        }
      });
  }
}
