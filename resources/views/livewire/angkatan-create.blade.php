<div>
    <form wire:submit='save'>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <flux:input wire:model='tahun_mulai' type="number" :label="'Tahun Mulai'"></flux:input>
            <flux:input wire:model='tahun_selesai' type="number" :label="'Tahun Selesai'"></flux:input>
        </div>
        <div class="flex justify-center mt-4">
            <flux:button variant="primary" type="submit">Submit</flux:button>
        </div>
    </form>
</div>
