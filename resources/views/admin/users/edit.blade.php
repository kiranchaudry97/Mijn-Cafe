<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gebruiker wijzigen | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- ✅ Navigatie --}}
  @include('partials.nav')

  {{-- ✅ Hoofdinhoud --}}
  <main class="flex-grow flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white p-6 rounded shadow">
      <h1 class="text-2xl font-bold mb-6 text-center">✏️ Gebruiker wijzigen</h1>

      <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6 bg-white p-6 rounded shadow">
      @csrf
      @method('PUT')

      {{-- Naam --}}
      <div class="text-center">
        <label for="name" class="block font-semibold mb-1">Naam</label>
        <input id="name"
               name="name"
               type="text"
               value="{{ old('name', $user->name) }}"
               class="w-full border rounded p-2 text-center"
               required>
        @error('name')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- E-mail --}}
      <div class="text-center">
        <label for="email" class="block font-semibold mb-1">E-mail</label>
        <input id="email"
               name="email"
               type="email"
               value="{{ old('email', $user->email) }}"
               class="w-full border rounded p-2 text-center"
               required>
        @error('email')
          <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Admin-rechten --}}
      <div class="flex justify-center items-center space-x-2">
        <input id="is_admin"
               name="is_admin"
               type="checkbox"
               value="1"
               class="border rounded"
               {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
        <label for="is_admin" class="font-semibold">Admin-rechten geven</label>
      </div>
      @error('is_admin')
        <p class="text-red-600 text-sm text-center">{{ $message }}</p>
      @enderror

      {{-- Submit --}}
      <div class="text-center">
        <button type="submit"
                class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
          Opslaan
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

  {{-- ✅ Footer --}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Alle rechten voorbehouden.
    </div>
  </footer>

</body>
</html>
