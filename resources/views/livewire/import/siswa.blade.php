<div class="p-4">
    <div class="space-y-6">
        <div class="flex items-start gap-4">
            <div class="flex-none w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold">1</div>
            <div>
                <h3 class="font-bold">Download Template</h3>
                <p class="text-sm text-gray-600 mb-2">Download template file dibawah</p>
                <a wire:click='download' class="text-blue-600 hover:underline text-sm">Download Template.xlsx</a>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="flex-none w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold">2</div>
            <div>
                <h3 class="font-bold">Isi Data</h3>
                <p class="text-sm text-gray-600">Isi dengan data siswa sesuai format</p>
            </div>
        </div>

        <div class="flex items-start gap-4">
            <div class="flex-none w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center font-bold">3</div>
            <div>
                <h3 class="font-bold">Upload File</h3>
                <p class="text-sm text-gray-600 mb-2">Upload file xlsx ke kolom dibawah</p>
                <form wire:submit.prevent="import" enctype="multipart/form-data">
                    <input type="file" wire:model="file" class="border p-2 rounded block w-full mb-2">
                    @error('file') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror

                    
                    <flux:button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-2">Import</flux:button>
                </form>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">{{ session('message') }}</div>
    @endif
</div>
