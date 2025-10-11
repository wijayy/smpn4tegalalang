<div class="w-full p-4 rounded bg-white dark:bg-neutral-700 space-y-2">
    <div class="font-semibold text-sm">{{ $slot}}</div>
    @if (session()->has('success'))
        <div class="text-sm text-green-500">{{ session('success') }}</div>
    @elseif (session()->has('error'))
        <div class="text-sm text-rose-500">{{ session('error') }}</div>
    @endif
</div>
