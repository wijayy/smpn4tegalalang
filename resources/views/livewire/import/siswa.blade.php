<div class="p-4">
    <form wire:submit.prevent="import" enctype="multipart/form-data">
        <input type="file" wire:model="file" class="border p-2 rounded">
        @error('file') <span class="text-red-500">{{ $message }}</span> @enderror

        <flux:button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-2">Import</flux:button>
    </form>

    @if (session()->has('message'))
        <div class="mt-2 text-green-600">{{ session('message') }}</div>
    @endif
</div>
