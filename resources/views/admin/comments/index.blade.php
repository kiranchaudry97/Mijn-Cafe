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

  <main class="flex-grow flex justify-center py-12 px-4">
    <div class="w-full max-w-4xl space-y-8">

      <h1 class="text-3xl font-bold text-center text-gray-800">💬 Reactiebeheer</h1>

      @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded text-center shadow">
          {{ session('success') }}
        </div>
      @endif

      @forelse ($comments as $comment)
        <div class="bg-white p-6 rounded-lg shadow space-y-3">
          <div class="text-sm text-gray-600 text-center">
            <strong>{{ $comment->user->name ?? 'Anoniem' }}</strong>
            op
            @if($comment->news)
              <a href="{{ route('news.show', $comment->news) }}" class="text-blue-600 underline hover:text-blue-800">
                {{ $comment->news->title }}
              </a>
            @else
              <span class="italic text-gray-400">Onbekend nieuwsitem</span>
            @endif
            <span class="text-gray-500 block mt-1">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
          </div>

          @if ($comment->rating)
            <div class="flex justify-center">
              @for ($i = 1; $i <= 5; $i++)
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5 {{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                     fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.12 3.446
                           h3.622c.969 0 1.371 1.24.588 1.81l-2.931 2.13
                           1.11 3.422c.3.921-.755 1.688-1.54 1.118l-2.969-2.15
                           -2.969 2.15c-.785.57-1.84-.197-1.54-1.118l1.11-3.422
                           -2.93-2.13c-.783-.57-.38-1.81.588-1.81h3.622l1.12-3.446z"/>
                </svg>
              @endfor
            </div>
          @endif

          <p class="text-gray-800 text-center">{{ $comment->content }}</p>

          <div class="flex justify-center">
            <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}">
              @csrf
              @method('DELETE')
              <button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 text-sm">
                Verwijderen
              </button>
            </form>
          </div>
        </div>
      @empty
        <p class="text-center text-gray-600 italic">Er zijn nog geen reacties.</p>
      @endforelse

      <div class="text-center">
        {{ $comments->links() }}
      </div>

      <div class="text-center">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 underline hover:text-blue-800">
          ← Terug naar dashboard
        </a>
      </div>

    </div>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>