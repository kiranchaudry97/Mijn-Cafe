<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  {{-- Hoofdinhoud --}}
  <main class="flex-grow flex items-center justify-center py-12 px-4 pb-12">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-lg p-8">
      <h2 class="text-2xl font-bold mb-6 text-center">📬 Neem contact op met ons</h2>

       {{-- Contactgegevens --}}
      <div class="space-y-2 text-gray-700 mb-8">
        <p class="flex items-center justify-center space-x-2">
          <span>📍</span>
          <span>Marktstraat 1, 1000 Brussel</span>
        </p>
        <p class="flex items-center justify-center space-x-2">
          <span>📞</span>
          <span>012 345 678</span>
        </p>
        <p class="flex items-center justify-center space-x-2">
          <span>✉️</span>
          <span>info@mijncafe.be</span>
        </p>
      </div>


      @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded">
          {{ session('success') }}
        </div>
      @endif

      {{-- Contactformulier --}}
      <form action="{{ route('contact.send') }}" method="POST" class="space-y-4 text-left">
        @csrf

        <div>
          <label for="name" class="block font-semibold mb-1">Naam</label>
          <input id="name" name="name" type="text" value="{{ old('name') }}"
                 class="w-full border rounded p-2" required>
          @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="email" class="block font-semibold mb-1">E-mail</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}"
                 class="w-full border rounded p-2" required>
          @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="subject" class="block font-semibold mb-1">Onderwerp</label>
          <input id="subject" name="subject" type="text" value="{{ old('subject') }}"
                 class="w-full border rounded p-2" required>
          @error('subject') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
          <label for="message" class="block font-semibold mb-1">Bericht</label>
          <textarea id="message" name="message" rows="5"
                    class="w-full border rounded p-2" required>{{ old('message') }}</textarea>
          @error('message') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="text-center">
          <button type="submit"
                  class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Verstuur
          </button>
        </div>
      </form>
    </div>
  </main>

 {{-- Footer --}}
@include('partials.footer')

</body>
</html>
