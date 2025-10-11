<flux:modal :dismissible="false" name="tambah-prestasi" class="min-w-2xl!">
    <form wire:submit='save' class="">
        <div class="grid grid-cols-1 gap-4 w-full ">
            <flux:select required wire:model.live='siswa_id' label="Nama Siswa" placeholder="--Pilih Siswa--">
                @foreach ($siswa as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:input required wire:model.live='nama_prestasi' label="Nama Prestasi"></flux:input>
            <flux:input required wire:model.live='tahun' label="Tahun"></flux:input>
            <flux:select required wire:model.live='tingkat' label="Tingkat Prestasi" placeholder="--Pilih Tingkat Prestasi--">
                @foreach ($tingkat_prestasi as $item)
                    <flux:select.option value="{{ $item }}">{{ $item }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:textarea wire:model.live='keterangan' label="Keterangan"></flux:textarea>
            <div class="flex justify-center">
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </div>
        </div>

    </form>
</flux:modal>
