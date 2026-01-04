<div>
    <div class="flex justify-between flex-wrap md:flex-nowrap gap-4">
        <div class="w-full md:w-1/2">
            <flux:input wire:model.live='search' size="sm" placeholder="Cari Siswa"></flux:input>
        </div>
        <div class="w-full md:w-1/6">
            <flux:select wire:model.live='kelas' size="sm">
                <flux:select.option value="">-- Pilih Kelas -- </flux:select.option>

                @foreach ($kelass as $item)
                    <flux:select.option value="{{ $item->nama }}">{{ $item->nama }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>
        <div class="w-full md:w-1/6">
            <flux:input wire:model.live='tanggal_lahir' placeholder="Tanggal Lahir" size="sm" type="date">
            </flux:input>
        </div>
        @if (Auth::user()->role == 'admin')
            <div class="w-full md:w-1/6">
                <flux:button wire:click='openCreateModal' size="sm">Tambah Siswa</flux:button>
                <flux:button href="{{ route('siswa.import') }}" size="sm">Tambah Siswa Bulk</flux:button>
            </div>
        @endif
    </div>
    <div class="overflow-x-auto">
        <div class="flex gap-4 min-w-3xl text-xs md:text-sm font-semibold mt-4 py-2">
            <div class="w-10">#</div>
            <div class="w-1/5">Nama Siswa</div>
            <div class="w-1/5 text-center">Jenis Kelamin</div>
            <div class="w-1/5 text-center">Tanggal Lahir</div>
            <div class="w-1/5 text-center">Kelas</div>
            <div class="w-1/5 text-center">Angkatan</div>
            @if (Auth::user()->role == 'admin')
                <div class="w-1/5 text-center">Aksi</div>
            @endif

        </div>
        @if ($show)
            <div class="w-full min-h-96 flex justify-center items-center">
                Data Siswa Terlalu Banyak! Guanakan fitur filter untuk mencari data siswa
            </div>
        @else
            @forelse ($siswa as $item)
                <div class="flex gap-4 min-w-3xl text-xs md:text-sm py-1">
                    <div class="w-10">{{ $loop->iteration }}</div>
                    <div class="w-1/5">{{ $item->name }}</div>
                    <div class="w-1/5 text-center">{{ $item->jenis_kelamin }}</div>
                    <div class="w-1/5 text-center">{{ $item->tanggal_lahir->format('Y-m-d') }}</div>
                    <div class="w-1/5 text-center">{{ $item->kelas->nama }}</div>
                    <div class="w-1/5 text-center">
                        {{ $item->angkatan->tahun_mulai }}-{{ $item->angkatan->tahun_selesai }}
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <div class="flex gap-2 w-1/5 justify-center">
                            <flux:button size="xs" variant="primary" color="amber"
                                wire:click='openEditModal({{ $item->id }})'>Ubah</flux:button>
                            <flux:modal.trigger name='delete-{{ $item->id }}'>
                                <flux:button size="xs" variant="primary" color="red">Hapus</flux:button>
                            </flux:modal.trigger>
                        </div>
                    @endif
                </div>
                @if (Auth::user()->role == 'admin')
                    <flux:modal name="delete-{{ $item->id }}">
                        <div class="mt-4">Yakin ingin menghapus Siswa {{ $item->nama }}?</div>
                        <div class="flex justify-end">
                            <flux:button variant='danger' size="sm" wire:click='delete({{ $item->id }})'>Hapus
                            </flux:button>
                        </div>
                    </flux:modal>
                @endif
            @empty
                <div class="w-full min-h-96 flex justify-center items-center">
                    Data Siswa Tidak Ditemukan
                </div>
            @endforelse
        @endif
    </div>
    @if (Auth::user()->role == 'admin')
        @livewire('siswa-create')
    @endif
</div>
