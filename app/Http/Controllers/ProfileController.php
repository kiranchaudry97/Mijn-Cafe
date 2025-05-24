<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view('users.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Publiek profiel tonen van elke gebruiker.
     */
    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Werk het profiel van de gebruiker bij.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'nullable|string|max:50|unique:users,username,' . $user->id,
            'email'    => 'required|email|max:255|unique:users,email,' . $user->id,
            'birthday' => 'nullable|date',
            'bio'      => 'nullable|string|max:1000',
            'avatar'   => 'nullable|image|max:4096',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'avatar.image' => 'De profielfoto moet een geldig afbeeldingsbestand zijn.',
        ]);

        // Als e-mail is gewijzigd, reset verificatie
        if ($user->email !== $validated['email']) {
            $user->email_verified_at = null;
        }

        // Verwerk profielfoto
        if ($request->hasFile('avatar')) {
            // Verwijder oude foto als die bestaat
            if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
                Storage::disk('public')->delete($user->avatar_path);
            }

            $path = $request->file('avatar')->store('profile_photo', 'public');
            $validated['avatar_path'] = $path;
        }

        // Verwerk wachtwoord alleen als ingevuld
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->fill($validated)->save();

        return redirect()->route('dashboard')->with('status', 'Profiel bijgewerkt.');
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

        if ($user->avatar_path && Storage::disk('public')->exists($user->avatar_path)) {
            Storage::disk('public')->delete($user->avatar_path);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}