<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
  public function redirectToProvider($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  public function handleProviderCallback($provider)
  {
    $providerUser = Socialite::driver($provider)->stateless()->user();

    $username = strtolower($providerUser->getName()); // Convertir a minúsculas
    $username = preg_replace('/[^a-z0-9._-]/', '', $username);

    $timesUsernameTaken = User::where('username', 'like', "$username%")->count();
    $isUsernameTaken = $timesUsernameTaken > 0;

    $normalizedUsername = $isUsernameTaken
      ? $username . $timesUsernameTaken
      : $username;

    $user = User::firstOrCreate([
      'provider_id' => $providerUser->getId(),
    ], [
      'email' => $providerUser->getEmail(),
      'username' => $normalizedUsername,
      'password' => Hash::make(Str::random(16)),
      'provider' => $provider
    ]);

    if (is_null($user->email_verified_at)) {
      $user->email_verified_at = now();
      $user->save();
    }

    Auth::login($user);

    return redirect()->route('posts.index');
  }
}
