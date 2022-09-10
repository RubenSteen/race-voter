<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    /**
     * Redirecting to Discord oAuth.
     */
    public function discordLogin()
    {
        if (app()->environment() == 'local') {
            Auth::loginUsingId(\App\Models\User::all()->last()->id);

            return redirect()->intended(route('home'));
        }

        return Socialite::driver('discord')->redirect();
    }

    /**
     * Handle the given data by oAuth2 discord.
     */
    public function discordCallback(Request $request)
    {
        if (! $request->has('code', 'state')) {
            abort(500);
        }

        $discordUser = Socialite::driver('discord')->user();

        $user = \App\Models\User::updateOrCreate([
            'id' => $discordUser->id,
        ], [
            'id' => $discordUser->id,
            'name' => $discordUser->name,
            'nickname' => $discordUser->nickname,
            'avatar' => $discordUser->avatar,
            'token' => $discordUser->token,
            'token_expires_at' => \Carbon\Carbon::now()->addSeconds($discordUser->expiresIn),
            'refresh_token' => $discordUser->refreshToken,
        ]);

        Log::info("Discord user: {{ $user->nickname }} created an account");

        $login = \App\Models\User::findOrFail($discordUser->id);

        Auth::login($login);

        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('home');
    }
}
