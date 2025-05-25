<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>FAQ aanmaken | Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  {{-- Inhoud --}}
  <main class="flex-grow py-12">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
      <h1 class="text-2xl font-bold mb-6 text-center">➕ Nieuw FAQ-item</h1>

      <form action="{{ route('admin.faq.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
          <label class="block font-semibold mb-1">Categorie</label>
          <select name="faq_category_id" class="w-full border rounded p-2" required>
            <option value="">-- Kies een categorie --</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block font-semibold mb-1">Vraag</label>
          <input type="text" name="question" class="w-full border rounded p-2" required>
        </div>

        <div>
          <label class="block font-semibold mb-1">Antwoord</label>
          <textarea name="answer" rows="4" class="w-full border rounded p-2" required></textarea>
        </div>

        <div class="flex justify-between items-center">
          <a href="{{ route('admin.faq.index') }}" class="text-sm text-gray-600 hover:underline">
            ← Terug naar overzicht
          </a>
          <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Opslaan
          </button>
        </div>
      </form>
    </div>

    {{-- Terug naar overzicht --}}
      <div class="text-center mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 underline hover:text-gray-900">
          ← Terug naar overzicht
        </a>
      </div>
  </main>

 
 {{-- Footer --}}
@include('partials.footer')

</body>
</html>