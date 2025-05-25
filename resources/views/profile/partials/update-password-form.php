<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wachtwoord wijzigen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded shadow max-w-md w-full">
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Wijzig je wachtwoord</h1>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Huidig wachtwoord --}}
            <div>
                <label for="current_password" class="block font-semibold text-gray-700 mb-1">Huidig wachtwoord</label>
                <input id="current_password" name="current_password" type="password" required
                       class="w-full border border-gray-300 rounded p-3">
                @error('current_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nieuw wachtwoord --}}
            <div>
                <label for="password" class="block font-semibold text-gray-700 mb-1">Nieuw wachtwoord</label>
                <input id="password" name="password" type="password" required
                       class="w-full border border-gray-300 rounded p-3">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bevestig nieuw wachtwoord --}}
            <div>
                <label for="password_confirmation" class="block font-semibold text-gray-700 mb-1">Bevestig nieuw wachtwoord</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="w-full border border-gray-300 rounded p-3">
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">
                    Wijzig wachtwoord
                </button>
            </div>
        </form>
    </div>

</body>
</html>