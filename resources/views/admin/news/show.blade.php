<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ $news->title }}
        </h2>
    </x-slot>

    <div class="p-6 space-y-4">
        @if ($news->image_path)
            <img src="{{ asset('storage/' . $news->image_path) }}" class="w-full max-w-xl rounded shadow">
        @endif

        <p class="text-sm text-gray-600">
            Gepubliceerd op: {{ $news->published_at?->format('d/m/Y H:i') }}
            door {{ $news->user->name ?? 'onbekend' }}
        </p>

        <div class="prose max-w-full">
            {!! nl2br(e($news->content)) !!}
        </div>

    </div>
</x-app-layout>
