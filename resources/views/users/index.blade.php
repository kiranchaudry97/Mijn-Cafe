<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gebruikers | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow py-12 px-4">
    <div class="max-w-7xl mx-auto space-y-10">

      <h1 class="text-3xl font-bold text-center text-gray-800">👥 Gebruikersprofielen</h1>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($users as $user)
          <div class="bg-white p-6 rounded-lg shadow text-center space-y-3">
            


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


            {{-- Naam --}}
            <h2 class="font-semibold text-lg text-gray-800">
              <a href="{{ route('users.show', $user) }}" class="hover:underline">
                {{ $user->username ?? $user->name }}
              </a>
            </h2>

            {{-- Korte bio --}}
            @if($user->bio)
              <p class="text-sm text-gray-600 line-clamp-3">
                {{ Str::limit($user->bio, 80) }}
              </p>
            @else
              <p class="text-sm text-gray-400 italic">Geen bio beschikbaar</p>
            @endif
          </div>
        @endforeach
      </div>

      {{-- Paginatie --}}
      <div class="text-center">
        {{ $users->links() }}
      </div>

    </div>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>