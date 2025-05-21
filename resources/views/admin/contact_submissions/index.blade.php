
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact­inzendingen | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Nav --}}
  @include('partials.nav')

  {{-- Titel --}}
  <div class="flex flex-col items-center mt-12 mb-6 text-center">
    <h2 class="text-2xl font-bold text-gray-800">✉️ Contact­inzendingen</h2>
    <p class="text-gray-600">Overzicht van alle ingevulde contactformulieren</p>
  </div>

  {{-- Inhoud --}}
  <main class="flex-grow max-w-4xl mx-auto px-4">
    @if($subs->count())
      <table class="min-w-full bg-white shadow rounded overflow-hidden">
        <thead class="bg-gray-200">
          <tr>
            <th class="px-4 py-2 text-left">Naam</th>
            <th class="px-4 py-2 text-left">E-mail</th>
            <th class="px-4 py-2 text-left">Bericht</th>
            <th class="px-4 py-2 text-left">Datum</th>
          </tr>
        </thead>
        <tbody>
          @foreach($subs as $sub)
            <tr class="border-t">
              <td class="px-4 py-2">{{ $sub->name }}</td>
              <td class="px-4 py-2">{{ $sub->email }}</td>
              <td class="px-4 py-2">{{ Str::limit($sub->message, 50) }}</td>
              <td class="px-4 py-2">{{ $sub->created_at->format('d-m-Y H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

      {{-- Paginatie --}}
      <div class="mt-4">
        {{ $subs->links('pagination::tailwind') }}
      </div>
    @else
      <p class="text-center text-gray-600 py-12">Er zijn nog geen contact­inzendingen.</p>
    @endif

    {{-- Terug naar overzicht --}}
      <div class="text-center mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 underline hover:text-gray-900">
          ← Terug naar overzicht
        </a>
      </div>
  </main>

  {{-- Footer --}}
  <footer class="bg-white shadow p-4 text-center text-sm text-gray-500 mt-8">
    &copy; {{ date('Y') }} Mijn Café. Mijn Café - Project Backend Chaud-ry Kiran.
  </footer>

</body>
</html>
