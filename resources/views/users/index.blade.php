<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gebruikers | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow py-12 px-4">
    <h1 class="text-3xl font-bold text-center mb-8">Gebruikersprofielen</h1>

    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach ($users as $user)
        <div class="bg-white p-4 rounded shadow text-center">
          {{-- Profielfoto --}}
          <img src="{{ $user->avatar_path && file_exists(public_path('storage/' . $user->avatar_path))
                      ? asset('storage/' . $user->avatar_path)
                      : asset('images/default-avatar.png') }}"
               alt="{{ $user->username ?? $user->name }}"
               class="w-24 h-24 object-cover rounded-full mx-auto mb-3 shadow ring-2 ring-gray-200">

          {{-- Naam --}}
          <h2 class="font-semibold text-lg text-gray-800">
            <a href="{{ route('users.show', $user) }}" class="hover:underline">
              {{ $user->username ?? $user->name }}
            </a>
          </h2>
        </div>
      @endforeach
    </div>

    {{-- Paginatie --}}
    <div class="mt-8 text-center">
      {{ $users->links() }}
    </div>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>