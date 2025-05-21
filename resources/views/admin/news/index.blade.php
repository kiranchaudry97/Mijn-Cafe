<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nieuwsbeheer | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- ✅ Navigatie --}}
  @include('partials.nav')

  {{-- ✅ Hoofdinhoud --}}
  <main class="flex-grow max-w-5xl mx-auto py-12 px-4">
    {{-- Titel --}}
    <div class="text-center mb-6">
      <h1 class="text-2xl font-semibold text-gray-800 mb-4">📰 Nieuwsbeheer</h1>
      <a href="{{ route('admin.news.create') }}"
         class="inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
        ➕ Nieuw item
      </a>
    </div>

    {{-- Succesboodschap --}}
    @if (session('success'))
      <div class="max-w-xl mx-auto mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    {{-- Tabel of lege melding --}}
    @if ($newsItems->count())
      <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full border-collapse">
          <thead class="bg-gray-200">
            <tr>
              <th class="p-2 border">Titel</th>
              <th class="p-2 border">Auteur</th>
              <th class="p-2 border">Gepubliceerd</th>
              <th class="p-2 border">Acties</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($newsItems as $news)
              <tr class="border-b">
                <td class="p-2 border">{{ $news->title }}</td>
                <td class="p-2 border">{{ $news->user->name ?? 'Onbekend' }}</td>
                <td class="p-2 border">
                  {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d/m/Y H:i') : '-' }}
                </td>
                <td class="p-2 border flex space-x-4">
                  <a href="{{ route('admin.news.edit', $news) }}"
                     class="text-blue-600 hover:underline">Bewerken</a>
                  <form action="{{ route('admin.news.destroy', $news) }}"
                        method="POST"
                        onsubmit="return confirm('Weet je zeker dat je dit nieuwsitem wil verwijderen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-red-600 hover:underline">
                      Verwijderen
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Paginering --}}
      <div class="mt-6">
        {{ $newsItems->links() }}
      </div>
    @else
      <p class="text-center text-gray-600 mt-4">
        Er zijn nog geen nieuwsitems toegevoegd.
      </p>
    @endif

    
        {{-- Terug naar overzicht --}}
  
        <div class="text-center mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 underline hover:text-gray-900">
          ← Terug naar overzicht
        </a>
</div>
     
  </main>

  {{-- ✅ Footer --}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café - Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>