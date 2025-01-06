<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccountVerificationController extends Controller
{
  public function notice()
  {
    return Inertia::render('Auth/VerifyEmail');
  }

  public function verify(EmailVerificationRequest $request)
  {
    $request->fulfill();

    return redirect('/');
  }

  public function resend(Request $request)
  {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
  }
}
