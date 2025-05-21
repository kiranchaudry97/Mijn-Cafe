<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{--  Navigatie --}}
  @include('partials.nav')

  {{--  Menu --}}
  <main class="flex-grow">
    <section id="menu" class="max-w-6xl mx-auto py-12 px-4">
      <h3 class="text-2xl font-bold mb-6 text-center text-gray-700">Koffiemenu</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($coffees as $coffee)
          <div class="bg-white p-4 rounded shadow text-center">
            @if($coffee->image_path)
              <img src="{{ asset('storage/' . $coffee->image_path) }}"
                   alt="{{ $coffee->name }}"
                   class="w-32 h-32 object-cover mx-auto mb-3 rounded">
            @endif

            <h4 class="text-xl font-bold mb-1">{{ $coffee->name }}</h4>
            <p class="text-gray-600">{{ $coffee->description }}</p>
            <p class="font-semibold mt-2">€{{ number_format($coffee->price, 2) }}</p>

            @auth
              @if (!auth()->user()->is_admin)
                <form method="POST" action="{{ route('orders.store') }}" class="mt-4">
                  @csrf
                  <input type="hidden" name="coffee_id" value="{{ $coffee->id }}">
                  <input type="number" name="quantity" value="1" min="1"
                         class="w-16 border rounded px-2 py-1 text-center">
                  <button type="submit"
                          class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 mt-2">
                    Bestellen
                  </button>
                </form>
              @else
                <p class="mt-3 text-gray-400 italic">Admins kunnen niet bestellen</p>
              @endif
            @else
              <a href="{{ route('login') }}"
                 class="inline-block mt-4 bg-green-300 text-gray-700 px-4 py-1 rounded hover:bg-gray-400">
                Bestellen
              </a>
            @endauth

          </div>
        @endforeach
      </div>
    </section>
  </main>

  {{-- footer--}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-black-500">
      &copy; {{ date('Y') }} Mijn Café. Mijn Café - Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>