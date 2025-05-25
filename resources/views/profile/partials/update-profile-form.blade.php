<section class="bg-white shadow sm:rounded-lg p-8 space-y-6">
    <header class="text-center">
        <h2 class="text-2xl font-bold text-gray-800">Profielinformatie</h2>
        <p class="mt-1 text-sm text-gray-600">
            Pas je naam, e-mailadres, bio en profielfoto aan.
        </p>
    </header>

    {{-- Verificatie opnieuw verzenden --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Update formulier --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PATCH')

        {{-- Naam --}}
        <div>
            <label for="name" class="block font-semibold text-gray-700">Naam</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                   class="w-full border border-gray-300 rounded p-3 focus:ring-blue-500 focus:outline-none">
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- E-mail --}}
        <div>
            <label for="email" class="block font-semibold text-gray-700">E-mailadres</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                   class="w-full border border-gray-300 rounded p-3 focus:ring-blue-500 focus:outline-none">
            @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Bio --}}
        <div>
            <label for="bio" class="block font-semibold text-gray-700">Over mij</label>
            <textarea id="bio" name="bio" rows="4"
                      class="w-full border border-gray-300 rounded p-3 resize-none focus:ring-blue-500 focus:outline-none">{{ old('bio', $user->bio) }}</textarea>
            @error('bio') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Profielfoto --}}
        <div>
            <label for="profile_photo" class="block font-semibold text-gray-700">Profielfoto</label>
            @if ($user->profile_photo)
                <img src="{{ asset('storage/public' . $user->profile_photo) }}"
                     alt="Profielfoto"
                     class="w-24 h-24 rounded-full object-cover ring-2 ring-gray-300 shadow mx-auto mb-4">
            @endif
            <input id="profile_photo" name="profile_photo" type="file"
                   class="w-full border border-gray-300 rounded p-3 text-sm">
            <div id="preview-container"></div>
            @error('profile_photo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Opslaan --}}
        <div class="text-center">
            <button type="submit"
                    class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">
                Opslaan
            </button>
            @if (session('status') === 'profile-updated')
                <p class="mt-2 text-sm text-green-600">Opgeslagen.</p>
            @endif
        </div>
    </form>
</section>