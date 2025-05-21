<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mijn Bestellingen | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{--  Navigatie --}}
  <nav class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
      <h1 class="text-2xl font-bold text-gray-800">☕ Mijn Café</h1>
      <ul class="flex flex-wrap justify-center md:justify-end space-x-6 text-sm font-semibold">
        <li><a href="{{ route('home') }}" class="hover:text-gray-500">Home</a></li>
        <li><a href="{{ route('menu') }}" class="hover:text-gray-500">Menu</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-gray-500">Contact</a></li>
        <li><a href="{{ route('orders.create') }}" class="hover:text-gray-500">Nieuwe Bestelling</a></li>
        @auth
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="hover:text-red-500">Uitloggen</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </nav>

  {{--  Hoofdinhoud --}}
  <main class="flex-grow">
    {{-- Titel --}}
    <div class="flex flex-col items-center mt-6 mb-4 text-center">
      <h2 class="text-2xl font-bold text-gray-800">📋 Mijn Bestellingen</h2>
      <p class="text-gray-600">Overzicht van je geplaatste bestellingen</p>
    </div>

    {{-- Overzicht --}}
    <div class="p-6 max-w-4xl mx-auto">
      <ul class="space-y-4">
        @forelse ($orders as $order)
          <li class="border p-4 rounded bg-white shadow flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="text-center sm:text-left">
              <strong>☕ {{ $order->coffee->name ?? 'Onbekende koffie' }}</strong><br>
              Aantal: {{ $order->quantity }}<br>
              Datum: {{ $order->created_at->format('d-m-Y H:i') }}
            </div>
            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="mt-3 sm:mt-0">
              @csrf
              @method('DELETE')
              <button type="submit"
                      onclick="return confirm('Weet je zeker dat je deze bestelling wilt verwijderen?')"
                      class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                Verwijderen
              </button>
            </form>
          </li>
        @empty
          <li class="text-center text-gray-600 py-12 text-lg">
            Je hebt nog geen bestellingen geplaatst.
          </li>
        @endforelse
      </ul>
    </div>
  </main>

  {{-- Footer --}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Mijn Café - Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>
