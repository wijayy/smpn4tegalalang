<div>
    <div class="flex justify-end">
        <flux:button variant="primary" wire:click='openCreateModal' size="sm">Tambah Mapel</flux:button>
    </div>
    <div class="overflow-x-auto mt-4">
        <div class="flex gap-4 text-xs md:text-sm font-semibold py-2 items-center">
            <div class="w-10">#</div>
            <div class="w-2/5">Nama Mapel</div>
            <div class="w-1/5 text-center">Kode</div>
            <div class="w-1/5 text-center">Jumlah Jam/Minggu</div>
            <div class="w-1/5  text-center">Action</div>
        </div>
        @foreach ($mapels as $item)
            <div class="flex gap-4 text-xs md:text-sm py-1 items-center">
                <div class="w-10">{{ $loop->iteration }}</div>
                <div class="w-2/5">{{ $item->nama }}</div>
                <div class="w-1/5 text-center">{{ $item->kode }}</div>
                <div class="w-1/5 text-center">{{ $item->jumlah_jam }}</div>
                <div class="w-1/5  flex justify-center gap-2">
                    <flux:button size="xs" variant="primary" color="amber"
                        wire:click='openEditModal({{ $item->id }})'>Ubah</flux:button>
                    <flux:modal.trigger name='delete-{{ $item->id }}'>
                        <flux:button size="xs" variant="primary" color="red">Hapus</flux:button>
                    </flux:modal.trigger>
                </div>
            </div>
            <flux:modal name="delete-{{ $item->id }}">
                <div class="mt-4">Yakin ingin menghapus Mapel {{ $item->nama }}?</div>
                <div class="flex justify-end">
                    <flux:button variant='danger' size="sm" wire:click='delete({{ $item->id }})'>Hapus
                    </flux:button>
                </div>
            </flux:modal>
        @endforeach
    </div>

    @livewire('mapel-create')
</div>
