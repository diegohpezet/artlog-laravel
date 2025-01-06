<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FollowController extends Controller
{
  /**
   * Display a listing of users who are following the specified user
   */
  public function followers($userIdentifier)
  {
    $user = User::with(['follows', 'followers'])
      ->where('id', $userIdentifier)
      ->orWhere('username', $userIdentifier)
      ->firstOrFail();

    $followersIds = $user->followers()->get()->map(function ($follow) {
      return $follow->follower_id;
    });

    $followers = User::whereIn('id', $followersIds)->get();

    return Inertia::render('Users/Index', [
      'users' => $followers
    ]);
  }

  /**
   * Display a listing of users who the specified user is following
   */
  public function following($userIdentifier)
  {
    $user = User::with(['follows', 'followers'])
      ->where('id', $userIdentifier)
      ->orWhere('username', $userIdentifier)
      ->firstOrFail();

    $followingIds = $user->follows()->get()->map(function ($follow) {
      return $follow->followed_id;
    });

    $following = User::whereIn('id', $followingIds)->get();

    return Inertia::render('Users/Index', [
      'users' => $following
    ]);
  }

  /**
   * Follow the specified user
   */
  public function follow(User $user)
  {

    if ($user->id !== Auth::user()->id) {
      Follow::create([
        'follower_id' => Auth::user()->id,
        'followed_id' => $user->id
      ]);
    };

    return response()->json([
      'followed' => true,
      'follower_count' => $user->followers()->count()
    ]);
  }

  /**
   * Unfollow the specified user
   */
  public function unfollow(User $user)
  {
    Follow::where('follower_id', Auth::user()->id)
      ->where('followed_id', $user->id)
      ->delete();

    return response()->json([
      'followed' => false,
      'follower_count' => $user->followers()->count()
    ]);
  }
}
