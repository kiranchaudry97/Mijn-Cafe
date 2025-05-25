<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profiel van {{ $user->name }}</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow py-12 px-4">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow text-center space-y-6">

      <h1 class="text-2xl font-bold text-gray-800">👤 Profiel van {{ $user->username ?? $user->name }}</h1>

      {{-- Profielfoto --}}
      @if($user->profile_photo)
        <img src="{{ asset('storage/' . $user->profile_photo) }}"
             alt="Profielfoto"
             class="w-32 h-32 rounded-full object-cover ring-2 ring-gray-300 shadow mx-auto">
      @else
        <img src="{{ asset('images/avatar.jpg') }}"
             alt="Standaard profielfoto"
             class="w-32 h-32 rounded-full object-cover ring-2 ring-gray-300 shadow mx-auto">
      @endif

      {{-- Gebruikersinformatie --}}
      <div class="text-left space-y-2 mt-6">
        <p><strong>Naam:</strong> {{ $user->name }}</p>

        @if($user->username)
          <p><strong>Gebruikersnaam:</strong> {{ $user->username }}</p>
        @endif

        <p><strong>Email:</strong> {{ $user->email }}</p>

        @if($user->birthday)
          <p><strong>Verjaardag:</strong> {{ $user->birthday->format('d-m-Y') }}</p>
        @endif

        @if($user->bio)
          <p><strong>Over mij:</strong> {{ $user->bio }}</p>
        @else
          <p class="text-sm text-gray-500 italic">Geen beschrijving beschikbaar.</p>
        @endif
      </div>

      {{-- Teruglink --}}
      <div class="mt-6">
        <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">
          ← Terug naar gebruikerslijst
        </a>
      </div>

    </div>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>