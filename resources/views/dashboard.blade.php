<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  {{-- Hoofdinhoud --}}
  <main class="flex-grow py-12">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow text-center space-y-6">

      <h1 class="text-2xl font-bold text-gray-800">🎉 Welkom terug, {{ Auth::user()->name }}!</h1>
      <p class="text-gray-600">Je bent ingelogd op het dashboard.</p>

      {{-- Gebruikersinformatie --}}
      <div class="mt-8 space-y-4 text-center">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">👤 Jouw profiel</h2>

        {{-- Profielfoto --}}
        @if(Auth::user()->avatar_url)
          <div class="flex justify-center">
            <img src="{{ Auth::user()->avatar_url }}"
                 alt="Profielfoto"
                 class="w-28 h-28 rounded-full object-cover ring-2 ring-gray-300 shadow">
          </div>
        @endif

        {{-- Profielgegevens --}}
        <div class="text-gray-800 mt-4 space-y-2">
          <p><strong>Naam:</strong> {{ Auth::user()->name }}</p>
          @if(Auth::user()->username)
            <p><strong>Gebruikersnaam:</strong> {{ Auth::user()->username }}</p>
          @endif
          <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
          @if(Auth::user()->birthday)
            <p><strong>Verjaardag:</strong> {{ Auth::user()->birthday->format('d-m-Y') }}</p>
          @endif
          @if(Auth::user()->bio)
            <p><strong>Over mij:</strong> {{ Auth::user()->bio }}</p>
          @endif
        </div>
      </div>

      {{-- Acties --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 justify-items-center mt-8">
        <a href="{{ route('orders.index') }}"
           class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 w-full sm:w-auto">
          📋 Mijn bestellingen
        </a>
        <a href="{{ route('orders.create') }}"
           class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 w-full sm:w-auto">
          ➕ Nieuwe bestelling
        </a>
        <a href="{{ route('profile.edit') }}"
           class="bg-yellow-500 text-white px-5 py-2 rounded hover:bg-yellow-600 w-full sm:w-auto">
          ✏ Profiel bewerken
        </a>
      </div>

    </div>
  </main>

 {{-- Footer --}}
@include('partials.footer')

</body>
</html>