<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FAQ Bewerken | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow py-12">
    <div class="max-w-2xl mx-auto bg-white shadow-md rounded p-8">
      <h1 class="text-2xl font-bold text-center mb-6">✏ FAQ bewerken</h1>

      <form method="POST" action="{{ route('admin.faq.update', $faq) }}">
        @csrf
        @method('PUT')

        {{-- Categorie --}}
        <div class="mb-4">
          <label for="faq_category_id" class="block text-sm font-semibold mb-1">Categorie</label>
          <select name="faq_category_id" id="faq_category_id" class="w-full border rounded p-2">
            @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ $faq->faq_category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Vraag --}}
        <div class="mb-4">
          <label for="question" class="block text-sm font-semibold mb-1">Vraag</label>
          <input type="text" name="question" id="question"
                 value="{{ old('question', $faq->question) }}"
                 class="w-full border rounded p-2">
        </div>

        {{-- Antwoord --}}
        <div class="mb-4">
          <label for="answer" class="block text-sm font-semibold mb-1">Antwoord</label>
          <textarea name="answer" id="answer" rows="4"
                    class="w-full border rounded p-2">{{ old('answer', $faq->answer) }}</textarea>
        </div>

        {{-- Actieknoppen --}}
        <div class="flex justify-between items-center mt-6">
          <a href="{{ route('admin.faq.index') }}"
             class="text-sm text-gray-600 hover:underline">
            ← Terug naar overzicht
          </a>
          <button type="submit"
                  class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
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
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café — Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>