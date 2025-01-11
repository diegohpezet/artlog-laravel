<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasUsername = request()->query('username') && strlen(request()->query('username')) > 3;
        $users = $hasUsername ?
            User::where('username', 'like', '%' . request()->query('username') . '%')->get() :
            User::all();

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($userIdentifier)
    {
        $user = User::with(['follows', 'followers'])
            ->where('id', $userIdentifier)
            ->orWhere('username', $userIdentifier)
            ->firstOrFail();

        $likedPosts = $user->likes()->with('post')->get()->map(function ($like) {
            return $like->post;
        });

        return Inertia::render('Users/Show', [
            'user' => $user,
            'posts' => $user->posts->load('likes'),
            'likedPosts' => $likedPosts->load('likes')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userIdentifier)
    {
        $user = User::where('id', $userIdentifier)->orWhere('username', $userIdentifier)->firstOrFail();

        if (Auth::user()->id !== $user->id) {
            return redirect()->back();
        }

        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->username = $request->username;
        $user->description = $request->description;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars', $filename, 'public');
            $user->avatar = Storage::url($path);
        }

        $user->save();

        return redirect()->route('users.show', $user->username);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
