<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Toon het formulier om profielgegevens te bewerken.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Werk het profiel van de gebruiker bij.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'username'    => 'nullable|string|max:50|unique:users,username,' . $user->id,
            'email'       => 'required|email|max:255|unique:users,email,' . $user->id,
            'birthday'    => 'nullable|date',
            'bio'         => 'nullable|string|max:1000',
            'avatar'      => 'nullable|image|max:2048',
            'password'    => 'nullable|string|min:8|confirmed',
        ]);

        // E-mailadres gewijzigd? Reset verificatie
        if ($user->email !== $data['email']) {
            $user->email_verified_at = null;
        }

        // Avatar upload verwerken
        if ($request->hasFile('avatar')) {
            // Oude verwijderen
            if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            // Nieuwe opslaan
            $data['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }

        // Wachtwoord enkel bijwerken als ingevuld
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->fill($data)->save();

        return redirect()
            ->route('profile.edit')
            ->with('status', 'profile-updated');
    }

    /**
     * Verwijder het account van de gebruiker.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();

        if ($user->avatar_path) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}