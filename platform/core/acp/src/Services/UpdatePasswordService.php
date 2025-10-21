<?php

namespace Bng\Acp\Services;

use Bng\Acp\Models\User;
use Bng\Base\Facades\BaseHelper;
use Bng\Support\Services\ProduceServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UpdatePasswordService implements ProduceServiceInterface
{
  public function execute(Request $request): bool|User
  {
    $currentUser = $request->user();

    if (($userId = $request->input('id')) && $userId === $currentUser->getKey()) {
      $user = $currentUser;
    } else {
      $user = User::query()->findOrFail($userId);
    }

    $password = $request->input('password');

    $user->password = Hash::make($password);
    $user->save();

    /**
     * @var User $user
     */
    if ($user->getKey() != $currentUser->getKey()) {
      try {
        Auth::setUser($user);
        Auth::logoutOtherDevices($password);
      } catch (Throwable $exception) {
        BaseHelper::logError($exception);
      }
    }

    return $user;
  }
}
