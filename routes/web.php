<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AccountVerificationController;
use App\Http\Controllers\Auth\PasswordRecoveryController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::resource('users', UserController::class);

Route::resource('posts', PostController::class);
Route::get('/posts/{post}/likes', [PostController::class, 'likedBy'])->name('posts.likes');

Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register.post');

    Route::get('email/verify', [AccountVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [AccountVerificationController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('email/verification-notification', [AccountVerificationController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('forgot-password', [PasswordRecoveryController::class, 'showResetForm'])->name('password.reset');
    Route::post('send-recovery-email', [PasswordRecoveryController::class, 'sendRecoveryEmail'])->name('password.reset.post');
    Route::post('reset-password', [PasswordRecoveryController::class, 'resetPassword'])->name('password.reset.post');

    // Socialite routes
    Route::get('/{provider}/redirect', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirect');
    Route::get('/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.callback');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Filter routes
    Route::get('/posts/filter/{filter}', [PostController::class, 'index'])->name('posts.filter');

    // Like routes
    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::delete('/posts/{post}/like', [LikeController::class, 'unlike'])->name('posts.unlike');

    // Follow routes
    Route::get('/users/{user}/followers', [FollowController::class, 'followers'])->name('users.followers');
    Route::get('/users/{user}/following', [FollowController::class, 'following'])->name('users.following');
    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
    Route::delete('/users/{user}/follow', [FollowController::class, 'unfollow'])->name('users.unfollow');

    // Comment routes
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Update user
    Route::post('/users/{user}', [UserController::class, 'update'])->name('users.update');
});
