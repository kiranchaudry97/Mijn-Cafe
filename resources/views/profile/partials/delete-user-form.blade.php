<section class="space-y-6 max-w-xl mx-auto text-center">
    <header>
        <h2 class="text-lg font-bold text-gray-900">Account verwijderen</h2>
        <p class="mt-1 text-sm text-gray-600">
            Na verwijdering van je account worden al je gegevens permanent verwijderd.
        </p>
    </header>

    <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4 text-left">
        @csrf
        @method('DELETE')

        <label for="password" class="block font-semibold text-gray-700">Wachtwoord bevestigen</label>
        <input id="password" name="password" type="password" required
               class="w-full border border-gray-300 rounded p-3">
        @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

        <div class="flex justify-between mt-4">
            <button type="submit"
                    class="bg-red-600 text-white font-semibold px-6 py-2 rounded hover:bg-red-700 transition">
                Verwijder account
            </button>
            <a href="{{ route('dashboard') }}"
               class="text-gray-600 hover:underline self-center">Annuleren</a>
        </div>
    </form>
</section>