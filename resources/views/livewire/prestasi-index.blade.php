<div>
    <div class="flex justify-end gap-4">

        <flux:button wire:click="toogleFilter" variant="outline">Filter Data</flux:button>
        <flux:button wire:click="openCreateModal" variant="primary">Tambah Prestasi</flux:button>
    </div>
    @if ($filter)
        <div class="flex gap-4 items-end">
            <div class="grid grid-cols-1 mt-4 md:grid-cols-4 gap-4 w-full">
                <flux:input wire:model.live='siswa' placeholder="Nama Siswa"></flux:input>
                <flux:input wire:model.live='prestasi' placeholder="Nama Prestasi"></flux:input>
                <flux:select wire:model.live='tingkat' placeholder="--Tingkat Prestasi--">

                    @foreach ($tingkat_prestasi as $item)
                        <flux:select.option value="{{ $item }}">{{ $item }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:input wire:model.live='tahun' placeholder="Tahun"></flux:input>
            </div>
            <flux:button variant="danger" wire:click="resetFilter">Reset</flux:button>
        </div>
    @endif

    <div class="overflow-x-auto mt-4">
        <div class="flex gap-4 text-xs md:text-sm font-semibold py-2 items-center">
            <div class="w-10">#</div>
            <div class="w-1/6">Nama Siswa</div>
            <div class="w-1/6 text-center">Nama Prestasi</div>
            <div class="w-1/6 text-center">Tingkat Prestasi</div>
            <div class="w-1/6 text-center">Tahun</div>
            <div class="w-1/6 text-center">Keterangan</div>
            @if (Auth::user()->role == 'admin')
                <div class="w-1/6 text-center">Aksi</div>
            @endif
        </div>
        @foreach ($prestasis as $item)
            <div class="flex gap-4 text-xs md:text-sm py-1 items-center">
                <div class="w-10">{{ $loop->iteration }}</div>
                <div class="w-1/6">{{ $item->siswa->name }}</div>
                <div class="w-1/6 text-center">{{ $item->nama_prestasi }}</div>
                <div class="w-1/6 text-center">{{ $item->tingkat }}</div>
                <div class="w-1/6 text-center">{{ $item->tahun }}</div>
                <div class="w-1/6 text-center">{{ $item->keterangan }}</div>
                @if (Auth::user()->role == 'admin')
                    <div class="w-1/6 text-center f;ex justify-center">
                        <flux:button size="xs" variant="primary" color="amber"
                            wire:click='openEditModal({{ $item->id }})'>Ubah</flux:button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @livewire('prestasi-create')
</div>
