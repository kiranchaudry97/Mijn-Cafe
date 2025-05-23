<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $user->username ?? $user->name }} — Profiel</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  @include('partials.nav')

  <main class="flex-grow max-w-3xl mx-auto py-12">
    <div class="bg-white p-8 rounded shadow text-center space-y-4">
      <img src="{{ $user->avatar_url }}" alt="Avatar" class="mx-auto w-32 h-32 rounded-full object-cover">
      <h1 class="text-2xl font-bold">{{ $user->username ?? $user->name }}</h1>
      @if($user->birthday)
        <p>🎂 Geboren op: {{ \Illuminate\Support\Carbon::parse($user->birthday)->format('d-m-Y') }}</p>
      @endif
      @if($user->bio)
        <p class="italic">{{ $user->bio }}</p>
      @endif
      @auth
        @if(auth()->id() === $user->id)
          <a href="{{ route('profile.edit') }}"
             class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ✏️ Profiel bewerken
          </a>
        @endif
      @endauth
    </div>
  </main>

  {{-- Footer --}}
@include('partials.footer')
</body>
</html>
