<?php

namespace Bng\Acp\Http\Controllers\Auth;

use Bng\Acp\Models\User;
use Bng\Acp\Traits\AuthenticatesUsers;
use Bng\Base\Http\Controllers\BaseController;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;

class LoginController extends BaseController
{
  use AuthenticatesUsers;

  protected string $redirectTo = '/';

  public function __construct()
  {
    $this->middleware('guest', ['except' => 'logout']);

    $this->redirectTo = route('dashboard.index');
  }

  public function showLoginForm()
  {
    $this->pageTitle(trans('core/acp::auth.login_title'));

    return view('core/acp::auth.login');
  }

  public function login(Request $request)
  {
    $request->merge([$this->username() => $request->input('username')]);

    $this->validateLogin($request);

    if (
      method_exists($this, 'hasTooManyLoginAttempts') &&
      $this->hasTooManyLoginAttempts($request)
    ) {
      $this->fireLockoutEvent($request);

      $this->sendLockoutResponse($request);
    }

    $user = User::query()->where([$this->username() => $request->input($this->username())])->first();

    if (!empty($user)) {
      if (! $user->activated) {
        return redirect()->back()
          ->withErrors(['username' => trans('core/acp::auth.login.not_active')])
          ->withInput();
      }
    }

    return app(Pipeline::class)->send($request)
      ->through(apply_filters('core_acl_login_pipeline', [
        function (Request $request, Closure $next) {
          if ($this->guard()->attempt(
            $this->credentials($request),
            $request->filled('remember')
          )) {
            return $next($request);
          }

          $this->incrementLoginAttempts($request);

          return $this->sendFailedLoginResponse();
        },
      ]))
      ->then(function (Request $request) {
        Auth::guard()->user()->update(['last_login' => Carbon::now()]);

        if (! session()->has('url.intended')) {
          session()->flash('url.intended', url()->current());
        }

        if ($this->attemptLogin($request)) {
          return $this->sendLoginResponse($request);
        }
      });
  }

  public function username()
  {
    return filter_var(request()->input('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
  }

  public function logout(Request $request)
  {

    $this->guard()->logout();

    $request->session()->invalidate();
    return redirect()->route('access.login')->with(['message' => trans('core/acp::auth.login.logout_success')]);
  }

  protected function attemptLogin(Request $request): bool
  {
    return $this->guard()->attempt(
      $this->credentials($request),
      $request->filled('remember')
    );
  }
}
