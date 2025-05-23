<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profiel bewerken | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow py-12">
    <div class="max-w-3xl mx-auto space-y-6 px-4">

      <h1 class="text-2xl font-bold text-center">👤 Profiel bewerken</h1>

      {{-- Profielinformatie --}}
      <section class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-6 text-center">Persoonlijke gegevens</h2>

        @if(session('status'))
          <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
            {{ session('status') }}
          </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6 text-center">
          @csrf
          @method('PATCH')

          {{-- Naam --}}
          <div>
            <label for="name" class="block font-semibold mb-2">Naam</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                   class="mx-auto block w-full sm:w-2/3 border rounded p-2">
            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- E-mail (alleen tonen) --}}
          <div>
            <label class="block font-semibold mb-2">E-mailadres</label>
            <p>{{ $user->email }}</p>
          </div>

          {{-- Verjaardag --}}
          <div>
            <label for="birthday" class="block font-semibold mb-2">Verjaardag</label>
            <input id="birthday" name="birthday" type="date"
                   value="{{ old('birthday', $user->birthday?->format('Y-m-d')) }}"
                   class="mx-auto block w-full sm:w-2/3 border rounded p-2">
            @error('birthday') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- Profielfoto --}}
          <div>
            <label for="avatar" class="block font-semibold mb-2">Profielfoto</label>
            @if($user->avatar_path)
              <img src="{{ $user->avatar_url }}"
                   alt="Profielfoto"
                   class="mx-auto mb-4 w-32 h-32 rounded-full object-cover ring-2 ring-gray-300 shadow">
            @endif
            <input id="avatar" name="avatar" type="file" accept="image/*"
                   class="mx-auto block w-full sm:w-2/3 border rounded p-2">
            @error('avatar') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- Bio --}}
          <div>
            <label for="bio" class="block font-semibold mb-2">Over mij</label>
            <textarea id="bio" name="bio" rows="4"
                      class="mx-auto block w-full sm:w-2/3 border rounded p-2">{{ old('bio', $user->bio) }}</textarea>
            @error('bio') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
          </div>

          {{-- Opslaan --}}
          <div>
            <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
              Opslaan
            </button>
          </div>

          {{-- Terug --}}
          <div>
            <a href="{{ route('dashboard') }}"
               class="mt-4 inline-block text-gray-600 hover:underline">
              ← Terug naar dashboard
            </a>
          </div>
        </form>
      </section>

      {{-- Extra formulieren --}}
      <section class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-center">Wachtwoord wijzigen</h2>
        @include('profile.partials.update-password-form')
      </section>

      <section class="bg-white shadow sm:rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4 text-red-600 text-center">Account verwijderen</h2>
        @include('profile.partials.delete-user-form')
      </section>

    </div>
  </main>

 {{-- Footer --}}
@include('partials.footer')
</body>
</html>