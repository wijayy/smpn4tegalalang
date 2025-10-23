<div class=" space-y-4">
    <div class="flex gap-4">
        <div>
            {{-- <label class="block text-sm font-medium">Kelas</label> --}}
            <flux:select wire:model.live="selectedKelasId" label="Kelas" class="border rounded px-2 py-1">
                @foreach ($kelasList as $kelas)
                    <flux:select.option value="{{ $kelas->id }}">{{ $kelas->nama }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>

        <div>
            {{-- <label class="block text-sm font-medium">Hari</label> --}}
            <flux:select wire:model.live="selectedHari" label="Hari" class="border rounded px-2 py-1">
                @foreach ($hariList as $hari)
                    <flux:select.option value="{{ $hari }}">{{ $hari }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </div>

    <table class="w-full border-collapse border text-sm mt-4">
        <thead class="bg-gray-100 dark:bg-neutral-700">
            <tr>
                <th class="border px-2 py-1 w-20">Jam Ke</th>
                <th class="border px-2 py-1">Mapel</th>
                <th class="border px-2 py-1">Guru</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jadwalData as $jamKe => $jadwal)
                <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-neutral-600 dark:even:bg-neutral-700">
                    <td class="border text-center px-2 py-1">{{ $jamKe }}</td>
                    <td class="border px-2 py-1">
                        <flux:select wire:model="jadwalData.{{ $jamKe }}.mapel_id"
                            class="border rounded px-1 py-0.5 w-full">
                            <flux:select.option value="">-- Pilih Mapel --</flux:select.option>
                            @foreach ($mapels as $mapel)
                                <flux:select.option value="{{ $mapel->id }}">{{ $mapel->kode }} -
                                    {{ $mapel->nama }}</flux:select.option>
                            @endforeach
                        </flux:select>
                    </td>
                    <td class="border px-2 py-1">
                        <flux:select wire:model="jadwalData.{{ $jamKe }}.guru_id"
                            class="border rounded px-1 py-0.5 w-full">
                            <flux:select.option value="{{ null }}">-- Pilih Guru --</flux:select.option>
                            @foreach ($gurus as $guru)
                                <flux:select.option value="{{ $guru->id }}">
                                    {{ $guru->kode }}-{{ $guru->name }}
                                </flux:select.option>
                            @endforeach
                        </flux:select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-right">
        <button wire:click="save" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Simpan Perubahan
        </button>
    </div>
</div>
