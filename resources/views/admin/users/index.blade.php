<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gebruikersbeheer | Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow max-w-5xl mx-auto py-12">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">👥 Gebruikersbeheer</h1>
      <a href="{{ route('admin.users.create') }}"
         class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        ➕ Nieuwe gebruiker
      </a>
    </div>

    <table class="min-w-full bg-white shadow rounded overflow-hidden">
      <thead class="bg-gray-200">
        <tr>
          <th class="px-4 py-2 text-left">Naam</th>
          <th class="px-4 py-2 text-left">E-mail</th>
          <th class="px-4 py-2 text-left">Admin?</th>
          <th class="px-4 py-2 text-center">Acties</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
          <tr class="border-b hover:bg-gray-50">
            <td class="px-4 py-2">{{ $user->name }}</td>
            <td class="px-4 py-2">{{ $user->email }}</td>
            <td class="px-4 py-2">
              @if($user->is_admin)
                <span class="text-green-600 font-semibold">Ja</span>
              @else
                <span class="text-gray-600">Nee</span>
              @endif
            </td>
            <td class="px-4 py-2 text-center space-x-4">
              <!-- Wijzig-link -->
              <a href="{{ route('admin.users.edit', $user) }}"
                 class="text-blue-600 hover:underline">
                Wijzig
              </a>

              <!-- Verwijder-formulier -->
              <form action="{{ route('admin.users.destroy', $user) }}"
                    method="POST"
                    class="inline-block"
                    onsubmit="return confirm('Weet je zeker dat je {{ $user->name }} wilt verwijderen?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-red-600 hover:underline">
                  Verwijder
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-4 py-6 text-center text-gray-600">
              Geen gebruikers gevonden.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <div class="mt-6">
      {{ $users->links() }}
    </div>

    {{-- Terug naar overzicht --}}
      <div class="text-center mt-6">
        <a href="{{ route('admin.dashboard') }}" class="text-gray-700 underline hover:text-gray-900">
          ← Terug naar overzicht
        </a>
      </div>
  </main>

  {{-- Footer --}}
  <footer class="bg-white shadow p-4">
    <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
      &copy; {{ date('Y') }} Mijn Café. Alle rechten voorbehouden.
    </div>
  </footer>

</body>
</html>
