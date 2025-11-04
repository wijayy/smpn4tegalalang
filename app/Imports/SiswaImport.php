<?php

namespace App\Imports;

use App\Models\Kelas;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Simpan ke tabel guru
            $user = User::create([
                'name' => $row['nama'],
                'email' => $row['email'],
                'password' => Setting::where('key', 'default_siswa_password')->value('value'),
                'role' => 'siswa',
                'force_reset_password' => true
            ]);

            $kelas = Kelas::where('nama', $row['kelas'])->first();

            if ($kelas->id <=5) {
                $angkatan_id = 4;
            } elseif ($kelas->id <=10) {
                $angkatan_id = 5;
            } else {
                $angkatan_id = 6;
            }


            $guru = Siswa::create([
                'user_id' => $user->id,
                'nis' => $row['nipd'],
                'nisn' => $row['nisn'],
                'tanggal_lahir' => $row['tanggal_lahir'],
                'jenis_kelamin' => $row['jk'],
                'angkatan_id' => $angkatan_id,
                'kelas_id' => $kelas->id,
                'siswa_tidak_mampu' => $row['siswa_tidak_mampu'],
                'status' => 'aktif',
                'alamat' => $row['alamat'],
                'no_telp' => $row['hp'],
            ]);
        }
    }
}
