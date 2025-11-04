<div>
    <div class="flex justify-between gap-4">
        <div class="w-full md:w-1/2">
            <flux:input wire:model.live='search' placeholder="Cari data admin"></flux:input>
        </div>
        <flux:button variant="primary" wire:click="openCreateModal">Tambah Admin</flux:button>
    </div>

    <div class="flex gap-4 py-2 ">
        <div class="w-10">#</div>
        <div class="w-1/4">Nama</div>
        <div class="w-1/4 text-center">Email</div>
        <div class="w-1/4 text-center">Verified</div>
        <div class="w-1/4 text-center">Aksi</div>
    </div>
    @foreach ($admins as $item)
        <div class="flex gap-4 py-2 ">
            <div class="w-10">{{ $loop->iteration }}</div>
            <div class="w-1/4">{{ $item->name }}</div>
            <div class="w-1/4 text-center">{{ $item->email }}</div>
            <div class="w-1/4 text-center flex justify-center">
                @if ($item->email_verified_at)
                    <flux:icon.check-check></flux:icon.check-check>
                @else
                    <flux:icon.x></flux:icon.x>
                @endif
            </div>
            <div class="w-1/4 text-center flex justify-center gap-4">
                <flux:button size="xs" variant="primary" color="amber"
                    wire:click='openEditModal({{ $item->id }})'>Ubah</flux:button>
                <flux:modal.trigger name='delete-{{ $item->id }}'>
                    <flux:button size="xs" variant="primary" color="red">Hapus</flux:button>
                </flux:modal.trigger>
            </div>
        </div>
        @if (Auth::user()->role == 'admin')
            <flux:modal name="delete-{{ $item->id }}">
                <div class="mt-4">Yakin ingin menghapus Admin {{ $item->nama }}?</div>
                <div class="flex justify-end">
                    <flux:button variant='danger' size="sm" wire:click='delete({{ $item->id }})'>Hapus
                    </flux:button>
                </div>
            </flux:modal>
        @endif
    @endforeach


    @livewire('admin-create')
</div>
