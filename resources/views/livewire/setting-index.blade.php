<form wire:submit='save' class="space-y-4">
    <flux:input wire:model='default_guru_password' label="Default Password untuk Guru"></flux:input>
    <flux:input wire:model='default_siswa_password' label="Default Password untuk Siswa"></flux:input>

    <div class="flex justify-center mt-4">
        <flux:button variant="primary" type="submit">Submit</flux:button>
    </div>
</form>
