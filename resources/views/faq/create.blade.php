<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nieuwe FAQ-categorie / -vraag | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Nav --}}
  @include('partials.nav')

  <main class="flex-grow max-w-md mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold text-center mb-6">➕ Nieuw FAQ-item</h1>

    <form action="{{ route('faq.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
      @csrf

      {{-- Kies categorie --}}
      <div>
        <label class="block font-semibold mb-1">Categorie</label>
        <select name="category_id" required class="w-full border rounded p-2">
          <option value="">— Kies categorie —</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
          @endforeach
        </select>
        @error('category_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      {{-- Vraag --}}
      <div>
        <label class="block font-semibold mb-1">Vraag</label>
        <input name="question" type="text" required
               class="w-full border rounded p-2" value="{{ old('question') }}">
        @error('question') <p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      {{-- Antwoord --}}
      <div>
        <label class="block font-semibold mb-1">Antwoord</label>
        <textarea name="answer" rows="4" required
                  class="w-full border rounded p-2">{{ old('answer') }}</textarea>
        @error('answer') <p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
      </div>

      {{-- Submit --}}
      <div class="text-right">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Opslaan
        </button>
      </div>
    </form>
  </main>

  {{-- Footer --}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Alle rechten voorbehouden.
    </div>
  </footer>

</body>
</html>