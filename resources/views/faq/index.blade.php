<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FAQ | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Nav --}}
  @include('partials.nav')


 {{-- Veelgestelde vragen --}}
    <section class="bg-gray-50 py-12">
      <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-6 text-center">❓ Veelgestelde Vragen</h2>

        @foreach($categories as $category)
          <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-2 text-center">{{ $category->name }}</h3>
            <ul class="space-y-2">
              @foreach($category->faqs as $faq)
                <li class="border rounded p-3 bg-white shadow-sm text-center">
                  <p class="font-semibold">{{ $faq->question }}</p>
                  <p class="text-sm text-gray-700 mt-1">{{ $faq->answer }}</p>
                </li>
              @endforeach
            </ul>
          </div>
        @endforeach

        {{-- Vraagformulier --}}
        <div class="mt-12 bg-white rounded shadow p-6 max-w-xl mx-auto">
          <h3 class="text-xl font-bold text-center mb-4 text-center">Heb je een vraag? Stel ze hier!</h3>
          @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-center">
              {{ session('success') }}
            </div>
          @endif
          <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
            @csrf
            <div>
              <label class="block text-sm font-medium">Naam</label>
              <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
              <label class="block text-sm font-medium">E-mailadres</label>
              <input type="email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
              <label class="block text-sm font-medium">Je vraag</label>
              <textarea name="message" rows="4" class="w-full border rounded px-3 py-2" required></textarea>
            </div>
            <div class="text-center">
              <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Verzenden
              </button>
            </div>
          </form>
        </div>

      </div>
  </main>

 {{-- Footer --}}
@include('partials.footer')

</body>
</html>