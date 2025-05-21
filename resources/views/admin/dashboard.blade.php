<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- ✅ Navigatie --}}
  @include('partials.nav')

  {{-- ✅ Hoofdinhoud --}}
  <main class="flex-grow py-12">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow text-center space-y-6">
      <h2 class="text-2xl font-bold text-gray-800">👑 Admin Dashboard</h2>
      <p class="text-gray-700">Welkom terug, <strong>{{ auth()->user()->name }}</strong>!</p>

      <ul class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
        <li class="p-4 bg-gray-50 rounded shadow">
          <a href="{{ route('admin.news.index') }}" class="font-semibold hover:underline">📰 Beheer Nieuws</a>
        </li>
        <li class="p-4 bg-gray-50 rounded shadow">
          <a href="{{ route('admin.contact_submissions.index') }}" class="font-semibold hover:underline">📬 Bekijk Contact-inzendingen</a>
        </li>
        <li class="p-4 bg-gray-50 rounded shadow">
          <a href="{{ route('admin.orders.index') }}" class="font-semibold hover:underline">🛒 Bekijk Bestellingen</a>
        </li>
        <li class="p-4 bg-gray-50 rounded shadow">
          <a href="{{ route('admin.users.index') }}" class="font-semibold hover:underline">👥 Beheer Gebruikers</a>
        </li>
        <li class="p-4 bg-gray-50 rounded shadow">
          <a href="{{ route('admin.faq.index') }}" class="font-semibold hover:underline">❓ Beheer FAQ</a>
        </li>
      </ul>

      <div class="flex flex-col sm:flex-row justify-center gap-4 mt-6">
        <a href="{{ route('admin.users.create') }}"
           class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
          ➕ Nieuwe gebruiker
        </a>
        <a href="{{ route('admin.faq.create') }}"
           class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
          ➕ Nieuwe FAQ
        </a>
      </div>
    </div>
  </main>

  {{-- ✅ Footer --}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Mijn Café - Project Backend Chaud-ry Kiran
    </div>
  </footer>

</body>
</html>