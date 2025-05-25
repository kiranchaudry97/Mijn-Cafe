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

        @if(session('status'))
            <div class="bg-green-100 text-green-800 p-4 rounded text-center shadow">
                {{ session('status') }}
            </div>
        @endif

        {{-- Update profielgegevens --}}
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded shadow">
            @csrf
            @method('PATCH')

            {{-- Naam --}}
            <div>
                <label for="name" class="block font-semibold text-gray-700">Naam</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                       class="w-full border border-gray-300 rounded p-3 focus:ring-blue-500 focus:outline-none">
                @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Gebruikersnaam --}}
            <div>
                <label for="username" class="block font-semibold text-gray-700">Gebruikersnaam</label>
                <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}"
                       class="w-full border border-gray-300 rounded p-3 focus:ring-blue-500 focus:outline-none">
                @error('username') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- E-mailadres --}}
            <div>
                <label for="email" class="block font-semibold text-gray-700">E-mailadres</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                       class="w-full border border-gray-300 rounded p-3 focus:ring-blue-500 focus:outline-none">
                @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Verjaardag --}}
            <div>
                <label for="birthday" class="block font-semibold text-gray-700">Verjaardag</label>
                <input id="birthday" name="birthday" type="date" value="{{ old('birthday', optional($user->birthday)->format('Y-m-d')) }}"
                       class="w-full border border-gray-300 rounded p-3 focus:ring-blue-500 focus:outline-none">
                @error('birthday') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Over mij (bio) --}}
            <div>
                <label for="bio" class="block font-semibold text-gray-700">Over mij</label>
                <textarea id="bio" name="bio" rows="4"
                          class="w-full border border-gray-300 rounded p-3 resize-none focus:ring-blue-500 focus:outline-none">{{ old('bio', $user->bio) }}</textarea>
                @error('bio') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Profielfoto --}}
            <div>
                <label for="profile_photo" class="block font-semibold text-gray-700">Profielfoto</label>
                @if($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}"
                         alt="Profielfoto"
                         class="w-24 h-24 rounded-full object-cover ring-2 ring-gray-300 shadow mx-auto mb-4">
                @endif
                <input id="profile_photo" name="profile_photo" type="file"
                       class="w-full border border-gray-300 rounded p-3 text-sm">
                <div id="preview-container"></div>
                @error('profile_photo') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            {{-- Opslaan --}}
            <div class="text-center">
                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">
                    Profiel opslaan
                </button>
            </div>
        </form>

        {{-- Teruglink --}}
        <div class="text-center">
            <a href="{{ route('dashboard') }}" class="inline-block text-gray-600 hover:underline">
                ← Terug naar dashboard
            </a>
        </div>
    </div>
</main>

{{-- Footer --}}
@include('partials.footer')

{{-- JavaScript voor afbeelding preview --}}
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
                             class="mx-auto mt-4 w-32 h-32 rounded-full object-cover ring-2 ring-blue-300 shadow">`;
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