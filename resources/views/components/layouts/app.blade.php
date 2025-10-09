<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        <flux:session>{{ $title ?? null }}</flux:session>
        <div class="w-full p-4 rounded bg-white space-y-4">
            {{ $slot }}
        </div>
    </flux:main>
</x-layouts.app.sidebar>
