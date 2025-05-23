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
                    Bestel
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

            {{-- Reviews tonen --}}
<div class="mt-6 text-left">
  <h5 class="font-semibold mb-2 text-center">Reviews</h5>
  @forelse ($coffee->reviews as $review)
    <div class="bg-gray-100 p-2 rounded mb-2">
      <p class="text-sm text-gray-600 text-center">
        {{ $review->user->name ?? 'Anoniem' }} zei op {{ $review->created_at->format('d/m/Y H:i') }}:
      </p>
      <p class="text-gray-800">{{ $review->content }}</p>
    </div>
  @empty
    <p class="text-sm text-gray-500 text-center">Nog geen reviews.</p>
  @endforelse
</div>

  {{-- Reviewformulier met sterren --}}
@auth
  <form method="POST"
        action="{{ route('coffee.reviews.store', $coffee) }}"
        class="mt-4 flex flex-col items-center">
    @csrf

    <textarea name="content"
              rows="2"
              class="w-full max-w-md p-2 border rounded mb-3"
              placeholder="Jouw review..." required></textarea>

    {{-- Sterrenbeoordeling --}}
    <div class="flex space-x-1 mb-3">
      @for ($i = 1; $i <= 5; $i++)
        <label>
          <input type="radio" name="rating" value="{{ $i }}" class="hidden">
          <svg xmlns="http://www.w3.org/2000/svg"
               class="h-6 w-6 cursor-pointer text-gray-400 hover:text-yellow-400"
               fill="currentColor"
               viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.12 3.446a1 1 0 00.95.69h3.623c.969 0 1.371 1.24.588 1.81l-2.932 2.13a1 1 0 00-.364 1.118l1.12 3.446c.3.921-.755 1.688-1.54 1.118l-2.932-2.13a1 1 0 00-1.176 0l-2.932 2.13c-.784.57-1.838-.197-1.54-1.118l1.12-3.446a1 1 0 00-.364-1.118l-2.932-2.13c-.784-.57-.38-1.81.588-1.81h3.623a1 1 0 00.95-.69l1.12-3.446z"/>
          </svg>
        </label>
      @endfor
    </div>

    <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">
      Plaats review
    </button>
  </form>
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