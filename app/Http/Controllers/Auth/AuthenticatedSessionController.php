<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Toon de loginpagina.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Verwerk het loginverzoek.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $redirectTo = $request->input('redirect');

        // Als een redirect-parameter is meegegeven, volg die.
        if ($redirectTo) {
            return redirect()->intended($redirectTo);
        }

        // Standaard gedrag: admin of gebruiker
        return redirect()->intended(
            auth()->user()->is_admin ? '/admin/dashboard' : route('dashboard')
        );
    }

    /**
     * Uitloggen en sessie vernietigen.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}