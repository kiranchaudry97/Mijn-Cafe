<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nieuwe gebruiker | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  {{--  Hoofdinhoud --}}
  <main class="flex-grow flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white p-6 rounded shadow">
      <h1 class="text-2xl font-bold mb-6.5 text-center">➕ Nieuwe gebruiker</h1>

      <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label for="name" class="block font-semibold mb-1">Naam</label>
          <input id="name" name="name" type="text" value="{{ old('name') }}"
                 class="w-full border rounded p-2" required>
          @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="email" class="block font-semibold mb-1">E-mail</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}"
                 class="w-full border rounded p-2" required>
          @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password" class="block font-semibold mb-1">Wachtwoord</label>
          <input id="password" name="password" type="password"
                 class="w-full border rounded p-2" required>
          @error('password')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="password_confirmation" class="block font-semibold mb-1">Bevestig wachtwoord</label>
          <input id="password_confirmation" name="password_confirmation" type="password"
                 class="w-full border rounded p-2" required>
        </div>

        <div class="flex items-center space-x-2">
          <input id="is_admin" name="is_admin" type="checkbox" value="1"
                 class="border rounded" {{ old('is_admin') ? 'checked' : '' }}>
          <label for="is_admin" class="font-semibold">Admin-rechten</label>
        </div>

        <div class="text-right">
          <button type="submit"
                  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Aanmaken
          </button>
        </div>
      </form>
    </div>

    {{-- Terug naar overzicht --}}
      <div class="text-center mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 underline hover:text-gray-900">
          ← Terug naar overzicht
        </a>
      </div>
  </main>

  {{--  Footer --}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Alle rechten voorbehouden.
    </div>
  </footer>

</body>
</html>
