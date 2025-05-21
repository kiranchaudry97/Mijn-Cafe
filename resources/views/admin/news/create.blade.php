<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>➕ Nieuws toevoegen | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- ✅ Navigatie --}}
  @include('partials.nav')

  {{-- ✅ Hoofdinhoud --}}
  <main class="flex-grow max-w-3xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold text-center mb-8">➕ Nieuws toevoegen</h1>

    <form method="POST"
          action="{{ route('admin.news.store') }}"
          enctype="multipart/form-data"
          class="bg-white p-6 rounded shadow space-y-6 text-center">
      @csrf

      <!-- Titel -->
      <div>
        <label for="title" class="block font-semibold mb-1 text-center">Titel</label>
        <input id="title"
               type="text"
               name="title"
               class="w-full border rounded p-2 text-center"
               required>
        @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Inhoud -->
      <div>
        <label for="content" class="block font-semibold mb-1 text-center">Inhoud</label>
        <textarea id="content"
                  name="content"
                  rows="5"
                  class="w-full border rounded p-2 text-center"
                  required></textarea>
        @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Afbeelding -->
      <div>
        <label for="image" class="block font-semibold mb-1 text-center">Afbeelding (optioneel)</label>
        <input id="image"
               type="file"
               name="image"
               class="w-full">
        @error('image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <!-- Publicatiedatum -->
      <div>
        <label for="published_at" class="block font-semibold mb-1 text-center">Publicatiedatum</label>
        <input id="published_at"
               type="datetime-local"
               name="published_at"
               class="w-full border rounded p-2 text-center">
        @error('published_at') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
          Opslaan
        </button>
      </div>
    </form>

      {{-- Terug naar overzicht --}}
      <div class="text-center mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 underline hover:text-gray-900">
          ← Terug naar overzicht
        </a>
      </div>
  </main>
 
    
  {{-- ✅ Footer blijft onderaan --}}
  <footer class="bg-white shadow p-4 mt-auto">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Mijn Café - Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>
