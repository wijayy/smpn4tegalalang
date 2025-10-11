<div class="">
    <flux:modal class="min-w-2xl!" name='tambah-siswa'>
        <div class="mt-4 font-semibold">{{ $title }}</div>

        <form wire:submit='save' class="space-y-4">
            <flux:separator text="Informasi Akun">
            </flux:separator>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model.live='name' label="Nama Siswa" required></flux:input>
                <flux:input wire:model.live='email' type="email" label="Email Siswa" required></flux:input>
            </div>
            <flux:separator text="Informasi Siswa">
            </flux:separator>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model.live='nis' label="NIS" required></flux:input>
                <flux:input wire:model.live='nisn' label="NISN" required></flux:input>
                <flux:input wire:model.live='no_telp' only_number label="Nomor Telepon" required></flux:input>
                <flux:input wire:model.live='tanggal_lahir' type="date" label="Tanggal Lahir" required></flux:input>
                <flux:select wire:model.live='jenis_kelamin' label="Jenis Kelamin" required>
                    <flux:select.option value="L">Laki-Laki</flux:select.option>
                    <flux:select.option value="P">Perempuan</flux:select.option>
                </flux:select>
                <flux:select wire:model.live='angkatan_id' label="Angkatan" required>
                    <flux:select.option value="">-- Pilih Angkatan --</flux:select.option>
                    @foreach ($angkatan as $item)
                        <flux:select.option value="{{ $item->id }}">
                            {{ $item->tahun_mulai }}-{{ $item->tahun_selesai }}
                        </flux:select.option>
                    @endforeach
                </flux:select>
                <flux:select wire:model.live='kelas_id' label="Kelas" required>
                    <flux:select.option value="">-- Pilih Kelas --</flux:select.option>
                    @foreach ($kelas as $item)
                        <flux:select.option value="{{ $item->id }}">{{ $item->nama }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:select wire:model.live='status' label="Status Siswa" required>
                    <flux:select.option value="">-- Pilih Status --</flux:select.option>
                    <flux:select.option value="aktif">Aktif</flux:select.option>
                    <flux:select.option value="lulus">Lulus</flux:select.option>
                    <flux:select.option value="keluar">Keluar</flux:select.option>
                </flux:select>
                <flux:input wire:model.live='alamat' label="Alamat" required></flux:input>
            </div>
            <flux:checkbox wire:model.live='siswa_tidak_mampu' label="Siswa berasal dari keluarga tidak mampu">
            </flux:checkbox>

            <div class="flex justify-center">
                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
