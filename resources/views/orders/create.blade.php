<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nieuwe Bestelling | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

  {{-- Nav --}}
  <nav class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
      <h1 class="text-2xl font-bold">☕ Mijn Café</h1>
      <ul class="flex flex-wrap justify-center md:justify-end space-x-6 text-sm font-semibold">
        <li><a href="{{ route('home') }}" class="hover:text-gray-500">Home</a></li>
        <li><a href="{{ route('menu') }}" class="hover:text-gray-500">Menu</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-gray-500">Contact</a></li>
        <li><a href="{{ route('orders.index') }}" class="hover:text-gray-500">Mijn Bestellingen</a></li>
        <li>
          <form method="POST" action="{{ route('logout') }}">@csrf
            <button class="hover:text-red-500">Uitloggen</button>
          </form>
        </li>
      </ul>
    </div>
  </nav>

  {{-- Titel --}}
  <div class="text-center mt-6">
    <h2 class="text-2xl font-bold">🛒 Nieuwe Bestelling</h2>
    <p class="text-gray-600 mt-2">Kies je koffie en geef aantal op.</p>
  </div>

  {{-- Formulier --}}
  <div class="max-w-xl mx-auto p-6 bg-white rounded shadow mt-6">
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('orders.store') }}">
      @csrf
      <div class="mb-4">
        <label class="block font-semibold mb-1">Kies een koffie</label>
        <select name="coffee_id" required class="w-full border rounded p-2">
          <option value="">-- Kies --</option>
          @foreach($coffees as $coffee)
            <option value="{{ $coffee->id }}">
              {{ $coffee->name }} (€{{ number_format($coffee->price, 2) }})
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-4">
        <label class="block font-semibold mb-1">Aantal</label>
        <input type="number" name="quantity" value="1" min="1" class="w-full border rounded p-2">
      </div>
      <div class="flex flex-col items-center">
        <button type="submit"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
          Bestellen
        </button>
        <a href="{{ route('orders.index') }}"
           class="mt-4 text-gray-600 hover:underline flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 19l-7-7 7-7" />
          </svg>
          Terug naar overzicht
        </a>
      </div>
    </form>
  </div>

 {{-- Footer --}}
@include('partials.footer')

</body>
</html>