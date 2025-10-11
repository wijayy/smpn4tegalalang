<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mapel;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\JadwalMengajar;

class GenerateJadwal extends Command
{
    protected $signature = 'jadwal:generate';
    protected $description = 'Generate jadwal otomatis untuk semua kelas SMP';

    public function handle()
    {
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $jamPerHari = 7; // 7 jam pelajaran/hari
        $kelasList = Kelas::all();

        foreach ($kelasList as $kelas) {
            JadwalMengajar::where('kelas_id', $kelas->id)->delete();

            $slot = [];
            foreach ($hariList as $hari) {
                $slot[$hari] = array_fill(1, $jamPerHari, null);
            }

            // Upacara di Senin jam 1
            $slot['Senin'][1] = ['mapel' => 'Upacara', 'guru' => null];

            // Ambil semua mapel
            $mapels = Mapel::all();

            foreach ($mapels as $mapel) {
                $jamTersisa = $mapel->jumlah_jam;

                if ($mapel->mapel_besar && $jamTersisa == 5) {
                    // Mapel besar dibagi 3+2
                    $this->tempatkanMapel($slot, $mapel, 3, $mapel->boleh_senin);
                    $this->tempatkanMapel($slot, $mapel, 2, $mapel->boleh_senin);
                } else {
                    $this->tempatkanMapel($slot, $mapel, $jamTersisa, $mapel->boleh_senin);
                }
            }

            // Simpan ke DB
            foreach ($slot as $hari => $jams) {
                foreach ($jams as $jamKe => $isi) {
                    if ($isi && $isi['mapel'] !== 'Upacara') {
                        JadwalMengajar::create([
                            'kelas_id' => $kelas->id,
                            'mapel_id' => $isi['mapel']->id,
                            'guru_id' => Guru::inRandomOrder()->first()->id,
                            'hari' => $hari,
                            'jam_ke' => $jamKe
                        ]);
                    }
                }
            }
        }

        $this->info('✅ Jadwal berhasil digenerate.');
    }

    private function tempatkanMapel(&$slot, $mapel, $durasi, $bolehSenin)
    {
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];

        shuffle($hariList);

        foreach ($hariList as $hari) {
            if (!$bolehSenin && $hari == 'Senin') {
                continue;
            }

            for ($jam = 1; $jam <= count($slot[$hari]) - $durasi + 1; $jam++) {
                $bisa = true;

                for ($i = 0; $i < $durasi; $i++) {
                    if ($slot[$hari][$jam + $i] !== null) {
                        $bisa = false;
                        break;
                    }
                }

                if ($bisa) {
                    for ($i = 0; $i < $durasi; $i++) {
                        $slot[$hari][$jam + $i] = ['mapel' => $mapel, 'guru' => null];
                    }
                    return true;
                }
            }
        }
        return false;
    }
}
