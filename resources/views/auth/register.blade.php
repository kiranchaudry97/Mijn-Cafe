<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registreren — Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

  {{-- Navigatie --}}
  @include('partials.nav')

  <div class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white p-6 rounded shadow">
      <h2 class="text-xl font-bold text-center mb-6">📝 Nieuwe account aanmaken</h2>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Naam -->
        <div class="mb-4">
          <x-input-label for="name" :value="('Naam')" />
          <x-text-input id="name" class="w-full border rounded p-2 mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-600" />
        </div>

        <!-- E-mailadres -->
        <div class="mb-4">
          <x-input-label for="email" :value="('Email')" />
          <x-text-input id="email" class="w-full border rounded p-2 mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600" />
        </div>

        <!-- Wachtwoord -->
        <div class="mb-4">
          <x-input-label for="password" :value="('Wachtwoord')" />
          <x-text-input id="password" class="w-full border rounded p-2 mt-1" type="password" name="password" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600" />
        </div>

        <!-- Bevestig wachtwoord -->
        <div class="mb-6">
          <x-input-label for="password_confirmation" :value="('Bevestig wachtwoord')" />
          <x-text-input id="password_confirmation" class="w-full border rounded p-2 mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-600" />
        </div>

        <div class="flex justify-between items-center">
          <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">
            Al geregistreerd? Log in
          </a>
          <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Registreer
          </button>
        </div>
      </form>
    </div>
  </div>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>