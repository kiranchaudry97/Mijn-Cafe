<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  {{-- Menu --}}
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
                  <input type="number" name="quantity" value="1" min="1" class="w-16 border rounded px-2 py-1 text-center">
                  <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 mt-2">
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
                  <p class="text-gray-800 text-center">{{ $review->content }}</p>
                </div>
              @empty
                <p class="text-sm text-gray-500 text-center">Nog geen reviews.</p>
              @endforelse
            </div>

            {{-- Reviewformulier --}}
            <div class="mt-4">
              @auth
                <form method="POST" action="{{ route('coffee.reviews.store', $coffee) }}" class="flex flex-col items-center">
                  @csrf
                  <textarea name="content" rows="2" class="w-full max-w-md p-2 border rounded mb-3" placeholder="Jouw review..." required></textarea>
                  
                  <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Plaats review
                  </button>
                </form>
              @else
                <p class="mt-4 text-sm text-gray-600 text-center">
                  <a href="{{ route('login') }}" class="underline text-blue-600 hover:text-blue-800">
                    Log in
                  </a> om een commentaar te plaatsen.
                </p>
              @endauth
            </div>

          </div>
        @endforeach
      </div>
    </section>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

</body>
</html>