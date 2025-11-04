<?php

namespace App\Livewire;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use Livewire\Component;
use App\Models\JadwalMengajar;

class JadwalCreate extends Component
{
    public $selectedKelasId;
    public $selectedHari = 'Senin';
    public $kelasList = [];
    public $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    public $mapels = [];
    public $gurus = [];
    public $jadwalData = [];

    public function mount()
    {
        $this->kelasList = Kelas::all();
        $this->mapels = Mapel::all();
        $this->gurus = Guru::orderBy('kode')->get();
        $this->selectedKelasId = $this->kelasList->first()?->id;
        $this->loadJadwal();
    }

    public function updatedSelectedKelasId()
    {
        $this->loadJadwal();
    }

    public function updatedSelectedHari()
    {
        $this->loadJadwal();
    }

    public function loadJadwal()
    {
        $jadwals = JadwalMengajar::where('kelas_id', $this->selectedKelasId)
            ->where('hari', $this->selectedHari)
            ->orderBy('jam_ke')
            ->get();

        // Buat array jam ke 1–8 misalnya
        $this->jadwalData = collect(range(1, 8))->mapWithKeys(function ($jam) use ($jadwals) {
            $jadwal = $jadwals->firstWhere('jam_ke', $jam);
            return [$jam => [
                'id' => $jadwal->id ?? null,
                'mapel_id' => $jadwal->mapel_id ?? '',
                'guru_id' => $jadwal->guru_id ?? '',
            ]];
        })->toArray();
    }

    public function save()
    {
        foreach ($this->jadwalData as $jam_ke => $data) {
            JadwalMengajar::updateOrCreate(
                [
                    'id' => $data['id'],
                ],
                [
                    'kelas_id' => $this->selectedKelasId,
                    'hari' => $this->selectedHari,
                    'jam_ke' => $jam_ke,
                    'mapel_id' => $data['mapel_id'],
                    'guru_id' => $data['guru_id'] == '' ? null : $data['guru_id'],
                ]
            );
        }

        session()->flash('message', 'Jadwal berhasil diperbarui untuk hari ' . $this->selectedHari);
        $this->loadJadwal();
    }
    public function render()
    {
        return view('livewire.jadwal-create')->layout('components.layouts.app', ['title' => 'Buat Jadwal']);
    }
}
