<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wachtwoord vergeten | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

  {{-- Navigatie --}}
  <nav class="bg-gray-900 text-gray-200 shadow p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold text-white">
        <a href="{{ route('home') }}">☕ Mijn Café</a>
      </h1>
      <ul class="flex space-x-6 text-sm font-semibold">
        <li>
          <a href="{{ route('home') }}" class="hover:text-white hover:underline decoration-white">Home</a>
        </li>
      </ul>
    </div>
  </nav>

  {{-- Inhoud --}}
  <main class="flex-grow flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
      <h1 class="text-2xl font-bold text-center mb-6">Wachtwoord vergeten?</h1>

      <p class="mb-4 text-sm text-gray-600 text-center">
        Vul je e-mailadres in en ontvang een link om je wachtwoord opnieuw in te stellen.
      </p>

      {{-- Sessiestatus --}}
      @if (session('status'))
        <div class="mb-4 text-green-600 text-sm text-center">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}">
        @csrf

        {{-- E-mailadres --}}
        <div class="mb-4">
          <label for="email" class="block font-medium mb-1">E-mailadres</label>
          <input id="email" name="email" type="email"
                 class="w-full border border-gray-300 rounded px-3 py-2"
                 value="{{ old('email') }}" required autofocus>
          @error('email')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Verzenden --}}
        <div class="text-center">
          <button type="submit"
                  class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
            Verstuur herstel-link
          </button>
        </div>
      </form>
    </div>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>