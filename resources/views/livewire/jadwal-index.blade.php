<div>
    <div class="flex justify-between">
        <div class="">
            <flux:select wire:model.live='selectedKelasId'>
                @foreach ($kelasList as $item)
                    <flux:select.option value='{{ $item->slug }}'>{{ $item->nama }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <flux:button href="{{ route('jadwal.create') }}">Ubah Jadwal</flux:button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-4">
        @foreach ($jadwals as $items)
            <div class="rounded p-4 border border-gray-200 shadow">
                <div class="text-center mb-2 font-semibold text-lg md:text-xl">{{ $items[0]->hari }}</div>
                @foreach ($items as $item)
                    <div class="flex justify-between border-b border-black dark:border-white items-center">
                        <div class="w-5">{{ $item->jam_ke }}</div>
                        <div class="w-1/2">{{ $item->guru?->name ?? '-' }}</div>
                        <div class="w-1/2">{{ $item->mapel->nama }}</div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
