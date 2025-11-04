<form wire:submit='save'>
   <flux:modal name="tambah-admin">
    <div class="mt-4 font-semibold text-center">{{ $title }}</div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <flux:input wire:model.live='name' label="Nama" required></flux:input>
        <flux:input wire:model.live='email' label="Email" required></flux:input>
        <flux:input type="password" viewable wire:model.live='password' label="Password" required></flux:input>
        <flux:input type="password" viewable wire:model.live='password_confirmation' label="Konfirmasi Password" required></flux:input>
    </div>

    @if (!$errors->any())
        <div class="flex mt-4 justify-center">
            <flux:button variant="primary" type="submit">Simpan</flux:button>
        </div>
    @endif
   </flux:modal>
</form>
