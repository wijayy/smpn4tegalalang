<div>
    <flux:button wire:click='openCreateModal' size="sm" >Tambah Guru</flux:button>
    <div class="flex gap-4 mt-4 py-2">
        <div class="w-10">#</div>
        <div class="w-1/7">Nama Guru</div>
        <div class="w-1/7 text-center">Kode Guru</div>
        <div class="w-1/7 text-center">Mata Pelajaran</div>
        <div class="w-1/7 text-center">No Pegawai</div>
        <div class="w-1/7 text-center">No Telepon</div>
        <div class="w-1/7 text-center">Alamat</div>
        <div class="w-1/7 text-center">Aksi</div>
    </div>
    @foreach ($guru as $item)

    <div class="flex gap-4 text-xs md:text-sm py-1">
        <div class="w-10">{{ $loop->iteration }}</div>
        <div class="w-1/7">{{ $item->nama }}</div>
        <div class="w-1/7 text-center">{{ $item->kode }}</div>
        <div class="w-1/7 text-center">{{ $item->mapel->nama }}</div>
        <div class="w-1/7 text-center">{{ $item->no_pegawai ?? '-' }}</div>
        <div class="w-1/7 text-center">{{ $item->no_telp }}</div>
        <div class="w-1/7 text-center">{{ $item->alamat   }}</div>
        <div class="flex gap-2">
            <flux:button size="xs" variant="primary" color="amber" wire:click='openEditModal({{ $item->id }})'>Ubah</flux:button>
            <flux:modal.trigger name='delete-{{ $item->id }}'>
                <flux:button size="xs" variant="primary" color="red" >Hapus</flux:button>
            </flux:modal.trigger>
        </div>
    </div>
    <flux:modal name="delete-{{ $item->id }}">
        <div class="mt-4">Yakin ingin menghapus Guru {{ $item->nama }}?</div>
        <div class="flex justify-end">
            <flux:button variant='danger' size="sm" wire:click='delete({{ $item->id }})'>Hapus</flux:button>
        </div>
    </flux:modal>
    @endforeach

    @livewire('guru-create')

</div>
