<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nieuws bewerken | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- ✅ Navigatie --}}
  @include('partials.nav')

  {{-- ✅ Hoofdinhoud --}}
  <main class="flex-grow max-w-3xl mx-auto py-12 px-4">
    {{-- Titel --}}
    <h1 class="text-2xl font-bold text-center mb-6">✏ Nieuws bewerken</h1>

    <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" class="space-y-6 bg-white shadow rounded p-6">
      @csrf
      @method('PUT')

      {{-- Titel --}}
      <div>
        <label class="block text-sm font-medium text-gray-700">Titel</label>
        <input type="text" name="title" value="{{ old('title', $news->title) }}"
               class="mt-1 block w-full border rounded px-3 py-2" required>
      </div>

      {{-- Inhoud --}}
      <div>
        <label class="block text-sm font-medium text-gray-700">Inhoud</label>
        <textarea name="content" rows="5"
                  class="mt-1 block w-full border rounded px-3 py-2" required>{{ old('content', $news->content) }}</textarea>
      </div>

      {{-- Huidige afbeelding --}}
      @if ($news->image_path)
        <div>
          <label class="block text-sm font-medium text-gray-700">Huidige afbeelding:</label>
          <img src="{{ asset('storage/' . $news->image_path) }}" alt="Afbeelding" class="w-32 mt-2 rounded shadow">
        </div>
      @endif

      {{-- Nieuwe afbeelding --}}
      <div>
        <label class="block text-sm font-medium text-gray-700">Nieuwe afbeelding (optioneel)</label>
        <input type="file" name="image" class="mt-1 block w-full">
      </div>

      {{-- Publicatiedatum --}}
      <div>
        <label class="block text-sm font-medium text-gray-700">Publicatiedatum</label>
        <input type="datetime-local" name="published_at"
               value="{{ old('published_at', optional($news->published_at)->format('Y-m-d\TH:i')) }}"
               class="mt-1 block w-full border rounded px-3 py-2">
      </div>

      {{-- Submit --}}
      <div class="text-center">
        <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
          Bijwerken
        </button>
      </div>

      {{-- Terug-link --}}
      <div class="text-center mt-4">
        <a href="{{ route('admin.dashboard') }}"
           class="text-gray-600 underline hover:text-gray-800">
          ← Terug naar dashboard
        </a>
      </div>
    </form>
  </main>

  {{-- ✅ Footer --}}
  <footer class="bg-white shadow p-4 mt-6">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Project Backend Chaud-ry Kiran.
    </div>
  </footer>

</body>
</html>