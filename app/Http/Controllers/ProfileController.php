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
     * Publiek profiel tonen van een gebruiker.
     */
    public function show(User $user): View
    {
        return view('users.show', compact('user'));
    }

    /**
     * Werk het profiel bij.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'username'       => 'nullable|string|max:50|unique:users,username,' . $user->id,
            'email'          => 'required|email|max:255|unique:users,email,' . $user->id,
            'birthday'       => 'nullable|date',
            'bio'            => 'nullable|string|max:1000',
            'profile_photo'  => 'nullable|image|max:4096',
            'password'       => 'nullable|string|min:8|confirmed',
        ]);

        if ($user->email !== $validated['email']) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('profile_photo')) {
            // Verwijder bestaande afbeelding als die bestaat
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Sla nieuwe afbeelding op
            $path = $request->file('profile_photo')->store('profile_photo', 'public');
            $validated['profile_photo'] = $path;
        }

        // Verwerk wachtwoord indien ingevuld
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('dashboard')->with('status', 'Profiel bijgewerkt.');
    }

    /**
     * Verwijder account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Verwijder profielfoto indien aanwezig
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}