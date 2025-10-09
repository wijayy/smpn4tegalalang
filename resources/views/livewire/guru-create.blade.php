<div>
    <flux:modal :dismissible="false" class="md:min-w-2xl!" name="tambah-guru">
        <div class="mt-4">{{ $title }}</div>
        <form wire:submit='save' class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <flux:input wire:model.live='nama' label="Nama Guru" required></flux:input>
            <flux:input wire:model.live='kode' label="Kode Guru" required></flux:input>
            <flux:select wire:model='user_id' label="User">
                <flux:select.option value="">Hubungkan ke User</flux:select.option>
                @foreach ($users as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:select wire:model='mapel_id' label="Mapel">
                <flux:select.option value="">Pilih Mata Pelajaran</flux:select.option>
                @foreach ($mapels as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->nama }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:input wire:model.live='no_pegawai' only_number label="No Pegawai" required></flux:input>
            <flux:input wire:model.live='no_telp' only_number label="No Telepon" required></flux:input>
            <div class="md:col-span-2">
                <flux:input wire:model.live='alamat' label="Alamat" required></flux:input>
            </div>
            <div class="flex justify-center md:col-span-2">
                <flux:button variant="primary" type="submit">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
