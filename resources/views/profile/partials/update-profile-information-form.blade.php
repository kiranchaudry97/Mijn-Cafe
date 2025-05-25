<section class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow space-y-6 mt-12">
    <header class="text-center">
        <h2 class="text-2xl font-bold text-gray-800">Profielgegevens bijwerken</h2>
        <p class="mt-1 text-sm text-gray-600">
            Pas je naam, e-mailadres, bio en profielfoto aan.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Naam --}}
        <div>
            <label for="name" class="block font-semibold mb-1 text-gray-700">Naam</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                   class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- E-mailadres --}}
        <div>
            <label for="email" class="block font-semibold mb-1 text-gray-700">E-mailadres</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                   class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-700">
                    <p>Je e-mailadres is nog niet geverifieerd.</p>
                    <button form="send-verification"
                            class="underline text-blue-600 hover:text-blue-800">
                        Klik hier om de verificatie-e-mail opnieuw te verzenden
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            Een nieuwe verificatielink is verzonden!
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Bio --}}
        <div>
            <label for="bio" class="block font-semibold mb-1 text-gray-700">Over mij</label>
            <textarea id="bio" name="bio" rows="4"
                      class="w-full border border-gray-300 rounded p-3 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('bio', $user->bio) }}</textarea>
            @error('bio') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Profielfoto --}}
        <div>
            <label for="profile_photo" class="block font-semibold mb-1 text-gray-700">Profielfoto</label>
            @if ($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profielfoto"
                     class="w-24 h-24 object-cover rounded-full mb-4 mx-auto ring-2 ring-gray-300 shadow">
            @endif
            <input id="profile_photo" name="profile_photo" type="file"
                   class="w-full border border-gray-300 rounded p-3 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-gray-100">
            @error('profile_photo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Opslaan --}}
        <div class="text-center">
            <button type="submit"
                    class="bg-blue-600 text-white font-semibold px-8 py-3 rounded shadow hover:bg-blue-700 transition">
                Opslaan
            </button>
            @if (session('status') === 'profile-updated')
                <p class="mt-2 text-sm text-green-600">Je profiel is bijgewerkt.</p>
            @endif
        </div>
    </form>
</section>