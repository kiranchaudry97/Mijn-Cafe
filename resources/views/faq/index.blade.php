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

  <main class="flex-grow max-w-4xl mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold text-center mb-8">❓ Veelgestelde Vragen</h1>

    @foreach($categories as $category)
      <section class="mb-8">
        <h2 class="text-2xl font-semibold mb-4">{{ $category->name }}</h2>
        <dl class="space-y-4">
          @foreach($category->faqs as $faq)
            <div class="bg-white p-4 rounded shadow">
              <dt class="font-semibold">{{ $faq->question }}</dt>
              <dd class="mt-2 text-gray-700">{{ $faq->answer }}</dd>
            </div>
          @endforeach
        </dl>
      </section>
    @endforeach

  </main>

 {{-- Footer --}}
@include('partials.footer')

</body>
</html>