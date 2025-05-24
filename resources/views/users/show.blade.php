<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profiel van {{ $user->username ?? $user->name }} | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow max-w-3xl mx-auto py-12 px-6 text-center">
    {{-- Profielfoto --}}
    <div class="mb-6">
      <img src="{{ $user->avatar_url }}" alt="Profielfoto"
           class="w-32 h-32 rounded-full object-cover mx-auto shadow ring-2 ring-gray-300">
    </div>

    {{-- Gebruikersnaam --}}
    <h1 class="text-2xl font-bold mb-2">{{ $user->username ?? $user->name }}</h1>

    {{-- Verjaardag --}}
    @if($user->birthday)
      <p class="text-gray-600 mb-2">🎂 Verjaardag: {{ \Carbon\Carbon::parse($user->birthday)->format('d/m/Y') }}</p>
    @endif

    {{-- Over mij --}}
    @if($user->bio)
      <p class="text-gray-700 italic">{{ $user->bio }}</p>
    @endif
  </main>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>