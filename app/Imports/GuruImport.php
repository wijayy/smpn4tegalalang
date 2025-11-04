<?php

namespace App\Imports;

use App\Models\Guru;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        // dd($rows->toArray());
        foreach ($rows as $row) {

            try {
                 // Simpan ke tabel guru
            $user = User::create([
                'name' => $row['nama'],
                'email' => $row['email'],
                'password' => Setting::where('key', 'default_guru_password')->value('value'),
                'role' => 'guru',
                'force_reset_password' => true
            ]);

            $guru = Guru::create([
                'user_id' => $user->id,
                'kode' => $row['kode'],
                'no_pegawai' => $row['no_pegawai'],
                'alamat' => $row['alamat'],
                'no_telp' => $row['hp'],
                // 'mapel_id' => $row['mapel_id'],
            ]);
            } catch (\Throwable $th) {
                dd($row, $th->getMessage());
            }

        }
    }
}
