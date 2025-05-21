<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Toon lijst van gebruikers, nieuwste eerst.
     */
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Toon formulier om een nieuwe gebruiker aan te maken.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Verwerk het aanmaken van een nieuwe gebruiker.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'nullable|boolean',
        ]);

        $data['password'] = bcrypt($data['password']);
        // Checkbox geeft alleen waarde als aangevinkt
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;

        User::create($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Gebruiker aangemaakt.');
    }

    /**
     * Toon formulier om een bestaande gebruiker te bewerken.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Verwerk het updaten van admin-rechten.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'is_admin' => 'nullable|boolean',
        ]);

        // Zelfde checkbox-logica als bij aanmaken
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Rechten bijgewerkt.');
    }

    /**
     * Verwijder een gebruiker.
     */
    public function destroy(User $user)
    {
        // Voorkom dat een admin zichzelf per ongeluk verwijdert
        if (auth()->id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with('error', 'Je kunt jezelf niet verwijderen.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Gebruiker verwijderd.');
    }
}
