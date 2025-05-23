<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reactiebeheer | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow max-w-5xl mx-auto py-12 px-4">
    <h1 class="text-2xl font-bold mb-6 text-center">💬 Reactiebeheer</h1>

    @if(session('success'))
      <div class="bg-green-100 text-green-800 p-3 rounded mb-6 text-center">
        {{ session('success') }}
      </div>
    @endif

    @forelse ($comments as $comment)
      <div class="bg-white p-4 rounded shadow mb-4">
        <p class="text-sm text-gray-600 mb-1">
          <strong>{{ $comment->user->name ?? 'Anoniem' }}</strong> op
          <a href="{{ route('news.show', $comment->news) }}" class="underline text-blue-600 hover:text-blue-800">
            {{ $comment->news->title }}
          </a>
          <span class="text-gray-500">— {{ $comment->created_at->format('d/m/Y H:i') }}</span>
        </p>

        @if ($comment->rating)
          <div class="flex mb-1">
            @for ($i = 1; $i <= 5; $i++)
              <svg xmlns="http://www.w3.org/2000/svg"
                   class="h-5 w-5 {{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                   fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.12 3.446..." />
              </svg>
            @endfor
          </div>
        @endif

        <p class="text-gray-800 mb-2">{{ $comment->content }}</p>

        <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}">
          @csrf
          @method('DELETE')
          <button class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
            Verwijderen
          </button>
        </form>
      </div>
    @empty
      <p class="text-center text-gray-600">Er zijn nog geen reacties.</p>
    @endforelse

    <div class="mt-6">
      {{ $comments->links() }}
    </div>

    <div class="mt-8 text-center">
      <a href="{{ route('admin.dashboard') }}" class="text-gray-700 underline hover:text-gray-900">
        ← Terug naar dashboard
      </a>
    </div>
  </main>

  {{-- Footer --}}
  <footer class="bg-white shadow p-4 mt-auto">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café — Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>