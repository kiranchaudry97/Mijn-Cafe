<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nieuws | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow max-w-4xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-center mb-8">Laatste nieuws</h1>

    @foreach ($newsItems as $news)
      <article class="bg-white p-6 rounded shadow mb-6">
        <h2 class="text-xl font-semibold mb-2">
          <a href="{{ route('news.show', $news) }}" class="hover:underline">
            {{ $news->title }}
          </a>
        </h2>

        <p class="text-sm text-gray-600 mb-4">
          Gepubliceerd op {{ $news->published_at->format('d/m/Y H:i') }}
          door {{ $news->user->name ?? 'onbekend' }}
        </p>

        <div class="text-gray-700">
          {{ Str::limit(strip_tags($news->content), 150, '...') }}
        </div>

        <div class="mt-4">
          <a href="{{ route('news.show', $news) }}" class="text-blue-600 hover:underline">
            Lees meer →
          </a>
        </div>
      </article>
    @endforeach

    <div class="mt-8">
      {{ $newsItems->links() }} {{-- Paginatie --}}
    </div>
  </main>

  {{-- Footer --}}
@include('partials.footer')

</body>
</html>