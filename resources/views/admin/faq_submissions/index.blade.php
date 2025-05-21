<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingezonden Vragen | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- ✅ Navigatie --}}
  @include('partials.nav')

  {{-- ✅ Hoofdinhoud --}}
  <main class="flex-grow p-6 max-w-5xl mx-auto">
    <h1 class="text-xl font-bold text-center text-gray-800 mb-6">📥 Ingezonden Vragen</h1>

    @forelse($submissions as $submission)
      <div class="bg-white shadow rounded p-4 mb-4">
        <p><strong>Naam:</strong> {{ $submission->name }}</p>
        <p><strong>Email:</strong> {{ $submission->email }}</p>
        <p class="mt-2"><strong>Vraag:</strong><br>{{ $submission->message }}</p>
        <p class="text-sm text-gray-500 mt-2">Ingezonden op {{ $submission->created_at->format('d-m-Y H:i') }}</p>
      </div>
    @empty
      <p class="text-gray-600 text-center">Nog geen vragen ingezonden.</p>
    @endforelse

    {{-- ✅ Paginatie --}}
    <div class="mt-6">
      {{ $submissions->links() }}
    </div>
  </main>

  {{-- ✅ Footer --}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Mijn Café - Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>