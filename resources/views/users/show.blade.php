<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profiel van {{ $user->name }} | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  @include('partials.nav')

  <main class="flex-grow py-12 px-4">
    <div class="max-w-xl mx-auto bg-white p-8 rounded shadow text-center space-y-6">
      
      {{-- Profielfoto --}}
     @if($user->profile_photo)
    <img src="{{ asset('storage/' . $user->profile_photo) }}"
         alt="Profielfoto"
         class="w-32 h-32 rounded-full object-cover ring-2 ring-gray-300 shadow mx-auto">
@else
    <img src="{{ asset('images/default-avatar.png') }}"
         alt="Standaard profielfoto"
         class="w-32 h-32 rounded-full object-cover ring-2 ring-gray-300 shadow mx-auto">
@endif

      <h1 class="text-2xl font-bold text-gray-800">
        {{ $user->username ?? $user->name }}
      </h1>

      @if($user->bio)
        <div class="text-gray-700">
          <h2 class="font-semibold mb-2">Over mij:</h2>
          <p>{{ $user->bio }}</p>
        </div>
      @endif

      @if($user->birthday)
        <p><strong>Verjaardag:</strong> {{ $user->birthday->format('d-m-Y') }}</p>
      @endif
    </div>
  </main>

  @include('partials.footer')

</body>
</html>