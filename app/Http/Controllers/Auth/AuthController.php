<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
  public function showLoginForm()
  {
    return Inertia::render('Auth/Login');
  }

  public function login(LoginRequest $request)
  {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      return redirect()->intended('/');
    }

    return back()->withErrors([
      'default' => 'The provided credentials are incorrect.',
    ])->onlyInput('email');
  }

  public function showRegistrationForm()
  {
    return Inertia::render('Auth/Register');
  }

  public function register(RegisterRequest $request)
  {
    $user = User::create([
      'username' => $request->validated('username'),
      'email' => $request->validated('email'),
      'password' => Hash::make($request->validated('password')),
    ]);

    $user->sendEmailVerificationNotification();

    Auth::login($user);

    return redirect('/auth/email/verify');
  }

  public function logout()
  {
    Auth::logout();

    return redirect('/');
  }
}
