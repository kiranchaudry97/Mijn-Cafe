<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pasword update</title>
</head>
<body>
    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
    

    <div>
        <label for="current_password" class="block font-semibold text-gray-700">Huidig wachtwoord</label>
        <input id="current_password" name="current_password" type="password" required
               class="w-full border border-gray-300 rounded p-3">
        
    </div>

    <div>
        <label for="password" class="block font-semibold text-gray-700">Nieuw wachtwoord</label>
        <input id="password" name="password" type="password" required
               class="w-full border border-gray-300 rounded p-3">
       
    </div>

    <div>
        <label for="password_confirmation" class="block font-semibold text-gray-700">Bevestig nieuw wachtwoord</label>
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
</body>
</html>