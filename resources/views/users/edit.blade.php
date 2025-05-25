<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profiel bewerken | Mijn Café</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  {{-- Navigatie --}}
  @include('partials.nav')

  <main class="flex-grow py-12 px-4">
    <div class="max-w-4xl mx-auto space-y-10">

      <h1 class="text-3xl font-bold text-center text-gray-800">✏ Profiel bewerken</h1>

      @if (session('status'))
        <div class="bg-green-100 text-green-800 p-4 rounded text-center shadow">
          {{ session('status') }}
        </div>
      @endif

      {{-- Profielgegevens --}}
      <section class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4 text-center">Persoonlijke gegevens</h2>
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
          @csrf
          @method('PATCH')

          <div>
            <label for="name" class="block font-medium mb-1">Naam</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                   class="w-full border border-gray-300 rounded p-3" required>
            @error('name')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="username" class="block font-medium mb-1">Gebruikersnaam</label>
            <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}"
                   class="w-full border border-gray-300 rounded p-3">
            @error('username')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="email" class="block font-medium mb-1">E-mailadres</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                   class="w-full border border-gray-300 rounded p-3" required>
            @error('email')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="birthday" class="block font-medium mb-1">Geboortedatum</label>
            <input id="birthday" name="birthday" type="date" value="{{ old('birthday', optional($user->birthday)->format('Y-m-d')) }}"
                   class="w-full border border-gray-300 rounded p-3">
            @error('birthday')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="bio" class="block font-medium mb-1">Over mij</label>
            <textarea id="bio" name="bio"
                      class="w-full border border-gray-300 rounded p-3"
                      rows="4">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="profile_photo" class="block font-medium mb-1">Profielfoto</label>
            <input id="profile_photo" name="profile_photo" type="file"
                   class="w-full border border-gray-300 rounded p-3">
            <div id="preview-container" class="mt-4 text-center">
              @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}"
                     alt="Huidige profielfoto"
                     class="w-24 h-24 mx-auto rounded-full object-cover ring-2 ring-gray-300 shadow">
              @endif
            </div>
            @error('profile_photo')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
              Profiel opslaan
            </button>
          </div>
        </form>
      </section>

      {{-- Wachtwoord wijzigen --}}
      <section class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4 text-center">Wachtwoord wijzigen</h2>
        <form method="POST" action="{{ route('password.update') }}" class="space-y-4 max-w-md mx-auto">
          @csrf
          @method('PUT')

          <div>
            <label for="current_password" class="block font-medium mb-1">Huidig wachtwoord</label>
            <input id="current_password" name="current_password" type="password"
                   class="w-full border border-gray-300 rounded p-3" required>
            @error('current_password')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="password" class="block font-medium mb-1">Nieuw wachtwoord</label>
            <input id="password" name="password" type="password"
                   class="w-full border border-gray-300 rounded p-3" required>
            @error('password')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="password_confirmation" class="block font-medium mb-1">Bevestig nieuw wachtwoord</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   class="w-full border border-gray-300 rounded p-3" required>
          </div>

          <div class="text-center">
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600">
              Wachtwoord wijzigen
            </button>
          </div>
        </form>
      </section>

      {{-- Account verwijderen --}}
      <section class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold text-center text-red-600 mb-4">Account verwijderen</h2>
        <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4 max-w-md mx-auto">
          @csrf
          @method('DELETE')

          <div>
            <label for="delete_password" class="block font-medium mb-1">Bevestig wachtwoord</label>
            <input id="delete_password" name="password" type="password"
                   class="w-full border border-gray-300 rounded p-3" required>
            @error('password', 'userDeletion')
              <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
          </div>

          <div class="text-center">
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
              Verwijder account
            </button>
          </div>
        </form>
      </section>

      <div class="text-center mt-8">
        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:underline">
          ← Terug naar dashboard
        </a>
      </div>

    </div>
  </main>

  {{-- Footer --}}
  @include('partials.footer')

  {{-- JS voor profielfoto preview --}}
  <script>
    const fileInput = document.getElementById('profile_photo');
    const previewContainer = document.getElementById('preview-container');

    if (fileInput) {
      fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function (event) {
            previewContainer.innerHTML = `
              <img src="${event.target.result}" alt="Preview"
                   class="mx-auto mt-4 w-24 h-24 rounded-full object-cover ring-2 ring-blue-300 shadow">`;
          };
          reader.readAsDataURL(file);
        } else {
          previewContainer.innerHTML = '';
        }
      });
    }
  </script>

</body>
</html>