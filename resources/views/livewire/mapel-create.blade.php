<flux:modal name="tambah-mapel" class="min-w-2xl!">
    <form wire:submit='save' class="space-y-4">
        <flux:input wire:model='nama' label="Nama Mapel" required></flux:input>
        <flux:input wire:model='kode' label="Kode Mapel" required></flux:input>
        <flux:input wire:model='jumlah_jam' only_number label="Jumlah Jam" required></flux:input>
        <div class="flex justify-center">
            <flux:button variant="primary" type="submit">Simpan</flux:button>
        </div>
    </form>
</flux:modal>
