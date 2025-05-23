<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $news->title }} | Nieuws</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  {{-- Nieuwsbeheer --}}

  <main class="flex-grow max-w-3xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold text-center mb-8">{{ $news->title }}</h1>

    <div class="bg-white p-6 rounded shadow space-y-6 text-center">
      @if ($news->image_path)
        <div>
          <img src="{{ asset('storage/' . $news->image_path) }}"
               alt="Afbeelding bij nieuws"
               class="rounded mx-auto max-h-96 object-contain shadow">
        </div>
      @endif

      <p class="text-sm text-gray-600">
        Gepubliceerd op: {{ $news->published_at?->format('d/m/Y H:i') }}<br>
        Auteur: {{ $news->user->name ?? 'onbekend' }}
      </p>

      <div class="prose max-w-none text-left">
        {!! nl2br(e($news->content)) !!}
      </div>
    </div>

    <div class="text-center mt-6">
      <a href="{{ route('home') }}" class="text-gray-700 underline hover:text-gray-900">
        ← Terug naar home
      </a>
    </div>

    {{-- Reactie --}}

   {{-- Reacties --}}
    <div class="mt-12">
      <h2 class="text-xl font-semibold mb-4">Reacties</h2>

      @foreach ($news->comments as $comment)
        <div class="bg-white p-4 rounded shadow mb-4">
          <p class="text-sm text-gray-600 mb-1">
            {{ $comment->user->name ?? 'Anoniem' }} zei op {{ $comment->created_at->format('d/m/Y H:i') }}:
          </p>
          <p class="text-gray-800">{{ $comment->content }}</p>
        </div>
      @endforeach

      @auth
        <form method="POST" action="{{ route('comments.store', $news) }}" class="mt-6 bg-white p-6 rounded shadow">
          @csrf
          <label for="content" class="block font-semibold mb-2 text-left">Plaats een reactie:</label>
          <textarea name="content" id="content" rows="3" class="w-full p-2 border rounded" required></textarea>
          <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Reactie plaatsen
          </button>
        </form>
      @else
        <p class="mt-4 text-center text-gray-600">
          <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-800">
            Log in
          </a> om een reactie te plaatsen.
        </p>
      @endauth
    </div>
  </main>
  


  {{-- Footer --}}
  <footer class="bg-white shadow p-4 mt-auto">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Mijn Café - Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>