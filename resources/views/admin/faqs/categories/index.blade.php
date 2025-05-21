<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">📂 FAQ Categorieën</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('admin.faq-categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">➕ Nieuwe categorie</a>

        @if (session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        <ul class="mt-4 space-y-2">
            @foreach($categories as $category)
                <li class="flex justify-between items-center border-b pb-2">
                    <span>{{ $category->name }}</span>
                    <div class="space-x-2">
                        <a href="{{ route('admin.faq-categories.edit', $category) }}" class="text-blue-500 hover:underline">Bewerken</a>
                        <form action="{{ route('admin.faq-categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Verwijderen?')">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline">Verwijderen</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
