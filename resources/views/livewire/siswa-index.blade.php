<div>
    <flux:button wire:click='openCreateModal' size="sm">Tambah Siswa</flux:button>
    <div class="flex gap-4 mt-4 py-2">
        <div class="w-10">#</div>
        <div class="w-1/5">Nama Siswa</div>
        <div class="w-1/5 text-center">Jenis Kelamin</div>
        <div class="w-1/5 text-center">Tanggal Lahir</div>
        <div class="w-1/5 text-center">Kelas</div>
        <div class="w-1/5 text-center">Angkatan</div>
        <div class="w-1/5 text-center">Aksi</div>
    </div>
    @foreach ($siswa as $item)
        <div class="flex gap-4 text-xs md:text-sm py-1">
            <div class="w-10">{{ $loop->iteration }}</div>
            <div class="w-1/5">{{ $item->nama }}</div>
            <div class="w-1/5 text-center">{{ $item->jenis_kelamin }}</div>
            <div class="w-1/5 text-center">{{ $item->tanggal_lahir->format('Y-m-d') }}</div>
            <div class="w-1/5 text-center">{{ $item->kelas->first()->nama }}</div>
            <div class="w-1/5 text-center">{{ $item->angkatan->tahun_mulai }}-{{ $item->angkatan->tahun_selesai }}</div>
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

    @livewire('siswa-create')
</div>
