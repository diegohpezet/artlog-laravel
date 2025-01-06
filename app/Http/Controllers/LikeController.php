<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
  /**
   * Display a listing of users who liked the resource
   */
  public function likedBy(Post $post)
  {
    return $post->likes()->with('user')->get();
  }


  /**
   * Like a post.
   */
  public function like(Post $post)
  {
    Like::create([
      'user_id' => Auth::user()->id,
      'post_id' => $post->id
    ]);

    return response()->json([
      'liked' => true,
      'like_count' => $post->likes()->count()
    ]);
  }

  /**
   * Unlike a post
   */
  public function unlike(Post $post)
  {
    $like = Like::where('user_id', Auth::user()->id)
      ->where('post_id', $post->id)
      ->first();

    if ($like) {
      $like->delete();
    }

    return response()->json([
      'liked' => false,
      'like_count' => $post->likes()->count()
    ]);
  }
}
