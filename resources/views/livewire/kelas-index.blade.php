<div>
    <flux:button wire:click='openCreateModal' size="sm">Tambah Kelas</flux:button>
    <div class="flex gap-4 mt-4 py-2">
        <div class="w-10">#</div>
        <div class="w-1/5">Nama Kelas</div>
        <div class="w-1/5 text-center">Tingkat</div>
        <div class="w-1/5 text-center">Wali Kelas</div>
        <div class="w-1/5 text-center">Jumlah Siswa</div>
        <div class="w-1/5 text-center">Aksi</div>
    </div>
    @foreach ($kelas as $item)
        <div class="flex gap-4 text-xs md:text-sm py-1">
            <div class="w-10">{{ $loop->iteration }}</div>
            <div class="w-1/5">{{ $item->nama }}</div>
            <div class="w-1/5 text-center">{{ $item->tingkat }}</div>
            <div class="w-1/5 text-center">{{ $item->wali->nama }}</div>
            <div class="w-1/5 text-center">{{ $item->siswa->count() }}</div>
            <div class="flex gap-2 w-1/5 justify-center">
                <flux:button size="xs" variant="primary" color="amber"
                    wire:click='openEditModal({{ $item->id }})'>Ubah</flux:button>
                <flux:modal.trigger name='delete-{{ $item->id }}'>
                    <flux:button size="xs" variant="primary" color="red">Hapus</flux:button>
                </flux:modal.trigger>
            </div>
        </div>
        <flux:modal name="delete-{{ $item->id }}">
            <div class="mt-4">Yakin ingin menghapus Guru {{ $item->nama }}?</div>
            <div class="flex justify-end">
                <flux:button variant='danger' size="sm" wire:click='delete({{ $item->id }})'>Hapus
                </flux:button>
            </div>
        </flux:modal>
    @endforeach

    @livewire('kelas-create')
</div>
