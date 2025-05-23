<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $news->title }} | Nieuws bekijken</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  {{-- Hoofdinhoud --}}
  <main class="flex-grow max-w-3xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold text-center mb-8">{{ $news->title }}</h1>

    <div class="bg-white p-6 rounded shadow space-y-6 text-center">
      {{-- Afbeelding --}}
      @if ($news->image_path)
        <div>
          <img src="{{ asset('storage/' . $news->image_path) }}"
               alt="Afbeelding bij nieuws"
               class="rounded mx-auto max-h-96 object-contain shadow">
        </div>
      @endif

      {{-- Publicatiedatum en auteur --}}
      <p class="text-sm text-gray-600">
        Gepubliceerd op: {{ $news->published_at?->format('d/m/Y H:i') }}<br>
        Auteur: {{ $news->user->name ?? 'onbekend' }}
      </p>

      {{-- Inhoud --}}
      <div class="prose max-w-none text-left">
        {!! nl2br(e($news->content)) !!}
      </div>
    </div>

    {{-- Terug naar overzicht --}}
    <div class="text-center mt-6">
      <a href="{{ route('admin.news.index') }}" class="text-gray-700 underline hover:text-gray-900">
        ← Terug naar nieuwsbeheer
      </a>
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