<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profiel bewerken</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">

  @include('partials.nav')

  <main class="flex-grow max-w-md mx-auto py-12">
    @if(session('success'))
      <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
      </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
      @csrf @method('PUT')

      <div class="text-center">
        <img src="{{ auth()->user()->avatar_url }}" alt="Avatar" class="mx-auto w-24 h-24 rounded-full object-cover mb-2">
        <label class="block text-sm font-medium mb-1">Nieuwe profielfoto</label>
        <input type="file" name="avatar" class="mx-auto">
        @error('avatar') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block font-semibold">Username</label>
        <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}"
               class="w-full border rounded p-2">
        @error('username') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block font-semibold">Verjaardag</label>
        <input type="date" name="birthday" value="{{ old('birthday', auth()->user()->birthday) }}"
               class="w-full border rounded p-2">
        @error('birthday') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block font-semibold">Over mij</label>
        <textarea name="bio" rows="4" class="w-full border rounded p-2">{{ old('bio', auth()->user()->bio) }}</textarea>
        @error('bio') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
      </div>

      <div class="text-right">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          Opslaan
        </button>
      </div>
    </form>
  </main>

   {{-- Footer --}}
@include('partials.footer')
</body>
</html>
