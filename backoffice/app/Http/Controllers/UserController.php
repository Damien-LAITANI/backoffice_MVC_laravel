<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends CoreController {

    public function authentication(Request $request)
    {
        $error_email = $request->session()->get('errors') !== null ? $request->session()->get('errors')->first() : null;
        $this->show('user/authentication', [
            'error_email' => $error_email,
        ]);
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/categorie/ordre');
        }
        return back()->withErrors([
            'email' => 'L\'email ou le mot de passe ne correspond pas',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('disconnected', 'Vous avez bien été déconnecté');
        return redirect('/');
    }

}
