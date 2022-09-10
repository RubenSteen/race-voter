<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\Models\User::orderBy('created_at')
        ->get()
        ->map(fn ($user) => [
            'id' => strval($user->id), // Vue or Inertia changes the int to another value, not sure why so made it a string
            'nickname' => $user->nickname,
            'avatar' => $user->getAvatar(),
            'last_activity' => $user->last_activity->toDateTimeString(),
            'banned' => $user->isBanned(),
            'admin' => $user->isAdmin(),
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ]);

        return Inertia::render('User/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Make specified resource Admin or remove Admin status for from storage.
     *user
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function admin(User $user)
    {
        $user->admin();

        return redirect()->back()->with('success', 'Operation successful...');
    }

    /**
     * Ban/Unban the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function ban(User $user)
    {
        $user->ban();

        return redirect()->back()->with('success', 'Operation successful...');
    }
}
