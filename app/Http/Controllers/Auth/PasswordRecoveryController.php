<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PasswordRecoveryController extends Controller
{
  public function showResetForm(Request $request)
  {
    if ($request->query('token')) {
      return Inertia::render('Auth/ResetPassword', [
        'token' => $request->query('token'),
        'email' => $request->query('email')
      ]);
    }

    return Inertia::render('Auth/SendRecoveryEmail');
  }

  public function sendRecoveryEmail(Request $request)
  {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
      $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
      return back()->with('status', __($status));
    }

    return back()->withErrors([
      'email' => __($status),
    ]);
  }

  public function resetPassword(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|confirmed',
    ]);

    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user) use ($request) {
        $user->forceFill([
          'password' => Hash::make($request->password),
          'remember_token' => null,
        ])->save();
      }
    );

    if ($status === Password::PASSWORD_RESET) {
      return redirect()->route('login')->with('status', 'Your password has been reset successfully!');
    }

    return back()->withErrors([
      'email' => __($status),
    ]);
  }
}
