<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ request()->query('admin') ? 'Admin Login' : 'Gebruiker Login' }} — Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800">

  @php $admin = request()->query('admin'); @endphp

  <div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-white p-6 rounded shadow">
      <h2 class="text-xl font-bold text-center mb-6">
        {{ $admin ? '🔐 Admin Login' : '🔑 Gebruiker Login' }}
      </h2>

      <x-auth-session-status class="mb-4" :status="session('status')" />

      <form method="POST" action="{{ route('login') }}">@csrf
        @if($admin)
          <input type="hidden" name="admin" value="1">
        @endif

        <div class="mb-4">
          <label class="block font-semibold mb-1">Email</label>
          <input type="email" name="email" value="{{ old('email') }}" required autofocus
                 class="w-full border rounded p-2">
          <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600"/>
        </div>

        <div class="mb-4">
          <label class="block font-semibold mb-1">Wachtwoord</label>
          <input type="password" name="password" required class="w-full border rounded p-2">
          <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600"/>
        </div>

        <div class="mb-4 flex items-center">
          <input type="checkbox" name="remember" id="remember" class="mr-2">
          <label for="remember">Onthoud mij</label>
        </div>

        <div class="flex justify-between items-center">
          @if(Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:underline">
              Wachtwoord vergeten?
            </a>
          @endif
          <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Log in</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Footer --}}
@include('partials.footer')
</body>
</html>
