<div>
    <div class="flex justify-end">
        @if (Auth::user()->role == 'admin')
            <flux:button wire:click='openCreateModal' size="sm" variant='primary'>Tambah Guru</flux:button>
        @endif
    </div>
    <div class="overflow-x-auto mt-4">
        <div class="flex gap-4 min-w-3xl font-semibold text-xs md:text-sm mt-4 py-2">
            <div class="w-10">#</div>
            <div class="w-1/7">Nama Guru</div>
            <div class="w-1/7 text-center">Kode Guru</div>
            <div class="w-1/7 text-center">Mata Pelajaran</div>
            <div class="w-1/7 text-center">No Pegawai</div>
            <div class="w-1/7 text-center">No Telepon</div>
            <div class="w-1/7 text-center">Alamat</div>
            @if (Auth::user()->role == 'admin')
                <div class="w-1/7 text-center">Aksi</div>
            @endif
        </div>
        @foreach ($guru as $item)
            <div class="flex gap-4 min-w-3xl text-xs md:text-sm py-1">
                <div class="w-10">{{ $loop->iteration }}</div>
                <div class="w-1/7">{{ $item->name }}</div>
                <div class="w-1/7 text-center">{{ $item->kode }}</div>
                <div class="w-1/7 text-center">{{ $item->mapel?->nama }}</div>
                <div class="w-1/7 text-center">{{ $item->no_pegawai ?? '-' }}</div>
                <div class="w-1/7 text-center">{{ $item->no_telp }}</div>
                <div class="w-1/7 text-center">{{ $item->alamat }}</div>
                @if (Auth::user()->role == 'admin')
                    <div class="flex gap-2">
                        <flux:button size="xs" variant="primary" color="amber"
                            wire:click='openEditModal({{ $item->id }})'>Ubah</flux:button>
                        {{-- <flux:modal.trigger name='delete-{{ $item->id }}'>
                            <flux:button size="xs" variant="primary" color="red">Hapus</flux:button>
                        </flux:modal.trigger> --}}
                    </div>
                @endif
                @if (Auth::user()->role == 'admin')
                    <flux:modal name="delete-{{ $item->id }}">
                        <div class="mt-4">Yakin ingin menghapus Guru {{ $item->nama }}?</div>
                        <div class="flex justify-end">
                            <flux:button variant='danger' size="sm" wire:click='delete({{ $item->id }})'>Hapus
                            </flux:button>
                        </div>
                    </flux:modal>
                @endif
            </div>
        @endforeach

        @if (Auth::user()->role == 'admin')
            @livewire('guru-create')
        @endif
    </div>
</div>
