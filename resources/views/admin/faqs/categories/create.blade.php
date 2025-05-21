<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">➕ Categorie toevoegen</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('admin.faq-categories.store') }}" method="POST">
            @csrf
            <label class="block font-medium mb-2">Naam</label>
            <input type="text" name="name" class="border p-2 w-full mb-4" required>

            <button class="bg-green-600 text-white px-4 py-2 rounded">Opslaan</button>
        </form>
    </div>
</x-app-layout>
