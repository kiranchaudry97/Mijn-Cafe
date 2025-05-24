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
        $adminLogin = $request->has('admin');

        $request->authenticate();

        // Controleer of de gebruiker admin is indien gevraagd
        if ($adminLogin && !Auth::user()->is_admin) {
            Auth::logout();
            return back()->withErrors(['email' => 'Geen toegang tot het admin-gedeelte.']);
        }

        $request->session()->regenerate();

        // Eventuele redirect parameter
        $redirectTo = $request->input('redirect');

        if ($redirectTo) {
            return redirect()->intended($redirectTo);
        }

        // Admin dashboard of standaard dashboard
        return redirect()->intended(
            $adminLogin ? route('admin.dashboard') : route('dashboard')
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