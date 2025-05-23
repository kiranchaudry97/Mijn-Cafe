<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wachtwoord vergeten | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-md bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold text-center mb-6">Wachtwoord vergeten?</h1>

    <p class="mb-4 text-sm text-gray-600 text-center">
      Geen probleem. Vul je e-mailadres in en we sturen je een link om je wachtwoord opnieuw in te stellen.
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

  {{-- Footer --}}
@include('partials.footer')

</body>
</html>