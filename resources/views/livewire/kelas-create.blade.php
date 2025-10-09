<div>
    <flux:modal name='tambah-kelas'>
        <div class="mt-4">{{ $title }}</div>
        <form wire:submit='save' class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <flux:input wire:model='nama' label='Nama Kelas' required></flux:input>
            <flux:input wire:model='tingkat' label='Tingkat Kelas' required></flux:input>
            <flux:select wire:model='guru_id' label='Wali Kelas' required>
                <flux:select.option value="">-- Pilih Wali Kelas --</flux:select.option>
                @foreach ($guru as $item)
                <flux:select.option value="{{ $item->id }}">{{ $item->nama }}</flux:select.option>
                @endforeach
            </flux:select>
            <div class=""></div>
            <div class="md:col-span-2 flex justify-center">
                <flux:button type="submit" variant="primary" size="sm">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
