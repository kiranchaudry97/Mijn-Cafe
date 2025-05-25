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

            {{-- Titel --}}
            <h1 class="text-3xl font-bold text-center text-gray-800">✏ Profiel bewerken</h1>

            {{-- Statusmelding --}}
            @if(session('status'))
                <div class="bg-green-100 text-green-800 p-4 rounded text-center shadow">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Profielgegevens-formulier --}}
            @include('profile.partials.update-profile-form')

            {{-- Wachtwoord wijzigen --}}
            <section class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-center text-gray-800">Wachtwoord wijzigen</h2>
                @include('profile.partials.update-password-form')
            </section>

            {{-- Account verwijderen --}}
            <section class="bg-white shadow sm:rounded-lg p-6">
                <h2 class="text-xl font-semibold mb-4 text-red-600 text-center">Account verwijderen</h2>
                @include('profile.partials.delete-user-form')
            </section>

            {{-- Teruglink --}}
            <div class="text-center">
                <a href="{{ route('dashboard') }}"
                   class="inline-block mt-6 text-gray-600 hover:underline">
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