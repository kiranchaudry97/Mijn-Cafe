<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welkom | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow">

    {{-- Hero --}}
    <section class="text-center py-16 bg-white">
      <h2 class="text-4xl font-bold mb-4">Welkom bij ons Café</h2>
      <p class="text-base text-gray-600">Geniet van heerlijke koffie en warme sfeer ☕</p>
    </section>

    {{-- Welkomstbericht --}}
    <section class="bg-gray-50 py-12">
      <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Over Mijn Café</h2>
        <p class="text-gray-700 text-lg leading-relaxed">
          Bij <strong>Mijn Café</strong> draait alles om gezelligheid, kwaliteit en een heerlijke kop koffie.
          Of je nu een koffieliefhebber bent of gewoon wil genieten van een warme sfeer, je bent altijd welkom bij ons.
        </p>
      </div>
    </section>

    {{-- Koffiesoorten --}}
    <section class="py-16 bg-white">
      <div class="max-w-6xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-6">☕ Onze Koffiesoorten</h2>
        <p class="text-gray-600 mb-10">Bekijk ons assortiment en bestel jouw favoriet</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center items-start">
          @foreach ($coffees as $coffee)
            <div class="border rounded shadow p-6 bg-gray-50 text-center">
              @if($coffee->image_path && file_exists(public_path('storage/' . $coffee->image_path)))
                <img src="{{ asset('storage/' . $coffee->image_path) }}" alt="{{ $coffee->name }}"
                     class="mx-auto mb-4 w-40 h-40 object-cover rounded shadow">
              @else
                <div class="w-40 h-40 bg-gray-200 flex items-center justify-center mx-auto mb-4 rounded">
                  <span class="text-gray-500 text-sm">Geen afbeelding</span>
                </div>
              @endif
              <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $coffee->name }}</h3>
              <p class="text-gray-700 text-sm mb-4">{{ $coffee->description }}</p>
              <p class="text-lg font-bold text-gray-900 mb-4">€{{ number_format($coffee->price, 2) }}</p>
              <a href="{{ route('orders.create') }}"
                 class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Bestel
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    {{-- Nieuwssectie --}}
    @php use Illuminate\Support\Str; @endphp
    @if($newsItems->count())
    <section class="py-16 bg-gray-100">
      <div class="max-w-5xl mx-auto px-4" >


      
        <h2 class="text-3xl font-bold text-center mb-6">📰 Laatste Nieuws</h2>

        <div class=" max-w-5xl  place-items-center">
          @foreach ($newsItems as $news)
            <div class="bg-white rounded shadow p-6 mx-auto w-full max-w-xl">
              @if($news->image_path && file_exists(public_path('storage/' . $news->image_path)))
                <img src="{{ asset('storage/' . $news->image_path) }}"
                     alt="{{ $news->title }}"
                     class="mb-4 w-full h-40 object-cover rounded">
              @endif
              <h3 class="text-xl font-semibold text-gray-800 text-center">{{ $news->title }}</h3>
              <p class="text-sm text-gray-600 mb-2 text-center">
                Gepubliceerd op {{ \Carbon\Carbon::parse($news->published_at)->format('d/m/Y') }}
              </p>
              <p class="text-gray-700 text-sm line-clamp-3 text-center">
                {{ Str::limit(strip_tags($news->content), 100) }}
              </p>
              <div class="text-center mt-4">
              <a href="{{ route('news.show', $news) }}" class="inline-block mt-3 text-blue-600 hover:underline">
                Lees meer →
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    {{-- Veelgestelde vragen --}}
    <section class="bg-gray-50 py-12">
      <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-center mb-6">❓ Veelgestelde Vragen</h2>

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
          <h3 class="text-xl font-bold text-center mb-4">Heb je een vraag? Stel ze hier!</h3>
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
    </section>

  </main>

  {{-- Footer --}}
@include('partials.footer')

</body>
</html>