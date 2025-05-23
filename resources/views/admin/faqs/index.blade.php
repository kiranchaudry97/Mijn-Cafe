<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FAQ Beheer | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow p-6 space-y-10 max-w-7xl mx-auto">
    <h1 class="text-2xl font-bold text-center text-gray-800">🛠 FAQ Beheer</h1>

    {{-- FAQ Tabel --}}
    <table class="w-full border">
      <thead class="bg-gray-200 text-center">
        <tr>
          <th class="p-2 border">Categorie</th>
          <th class="p-2 border">Vraag</th>
          <th class="p-2 border">Antwoord</th>
          <th class="p-2 border">Acties</th>
        </tr>
      </thead>
      <tbody>
        @foreach($faqs as $faq)
          <tr class="border text-center">
            <td class="p-2 border">{{ $faq->category->name ?? '-' }}</td>
            <td class="p-2 border">{{ $faq->question }}</td>
            <td class="p-2 border">{{ $faq->answer }}</td>
            <td class="p-2 border flex justify-center gap-2">
              <a href="{{ route('admin.faq.edit', $faq) }}" class="text-blue-600 hover:underline">Bewerken</a>
              <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" onsubmit="return confirm('Verwijderen?')">
                @csrf
                @method('DELETE')
                <button class="text-red-600 hover:underline">Verwijderen</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{-- Paginatie --}}
    <div class="mt-4">
      {{ $faqs->links() }}
    </div>

    {{-- Validatie / success messages --}}
    @if ($errors->any())
      <div class="bg-red-100 text-red-600 p-2 rounded mb-4 max-w-md mx-auto">
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('success'))
      <div class="bg-green-100 text-green-700 p-3 rounded max-w-md mx-auto text-center">
        {{ session('success') }}
      </div>
    @endif

    {{-- Onderste knoppen --}}
    <div class="mt-10 space-y-6 text-center">
      {{-- Nieuw FAQ knop --}}
      <a href="{{ route('admin.faq.create') }}" class="inline-block bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700">
        ➕ Nieuw FAQ
      </a>

      {{-- Nieuwe categorie toevoegen --}}
      <div class="max-w-md mx-auto">
        <h2 class="text-lg font-semibold text-gray-800 text-center mb-2">➕ Nieuwe FAQ-categorie toevoegen</h2>

        <form action="{{ route('admin.faq-categories.store') }}" method="POST" class="space-y-3">
          @csrf
          <div>
            <label for="name" class="block text-sm font-medium text-center">Naam van categorie</label>
            <input type="text" name="name" id="name" class="border p-2 w-full rounded" required>
          </div>
          <div class="text-center">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
              Categorie toevoegen
            </button>
          </div>
        </form>
      </div>
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