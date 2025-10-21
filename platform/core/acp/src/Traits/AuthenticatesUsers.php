<?php

namespace Bng\Acp\Traits;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

trait AuthenticatesUsers
{
  use RedirectsUsers;
  use ThrottlesLogins;

  protected function validateLogin(Request $request): void
  {
    $request->validate([
      $this->username() => 'required|string',
      'password' => 'required|string',
    ]);
  }

  protected function guard(): StatefulGuard
  {
    return Auth::guard();
  }

  protected function credentials(Request $request): array
  {
    return $request->only($this->username(), 'password');
  }

  protected function sendFailedLoginResponse()
  {
    throw ValidationException::withMessages([
      $this->username() => [trans('auth.failed')],
    ]);
  }

  protected function sendLoginResponse(Request $request): Response|RedirectResponse
  {
    $request->session()->regenerate();

    $this->clearLoginAttempts($request);

    $this->authenticated($request, $this->guard()->user());

    return $request->wantsJson()
      ? new Response('', 204)
      : redirect()->intended($this->redirectPath());
  }

  protected function authenticated(Request $request, Authenticatable $user)
  {
    //
  }
}
