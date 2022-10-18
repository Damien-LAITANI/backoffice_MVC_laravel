<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class UserController extends CoreController
{
    /**
     * Méthode s'occupant d'afficher le formulaire de connexion
     *
     * @param Request $request
     * @return void
     */
    public function authentication(Request $request): void
    {
        $error_email = $request->session()->get('errors') !== null ? $request->session()->get('errors')->first() : null;
        $this->show('user/authentication', [
            'error_email' => $error_email,
        ]);
    }

    /**
     * Méthode s'occupant de traiter les informations envoyées par le formulaire de connexion
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function login(Request $request): Redirector|RedirectResponse|Application
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

    /**
     * Méthode permettant à un utilisateur de se déconnecter
     *
     * @param Request $request
     * @return Application|Redirector|RedirectResponse
     */
    public function logout(Request $request): RedirectResponse|Application|Redirector
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flash('disconnected', 'Vous avez bien été déconnecté');
        return redirect('/');
    }
}
