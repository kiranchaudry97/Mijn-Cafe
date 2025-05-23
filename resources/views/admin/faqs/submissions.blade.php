<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingezonden Vragen | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow p-6 max-w-5xl mx-auto">
    <h1 class="text-xl font-bold text-gray-800 mb-6 text-center">📥 Ingezonden Vragen</h1>

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

    <div class="mt-6">
      {{ $submissions->links() }}
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