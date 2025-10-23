<?php

namespace App\Livewire;

use App\Models\JadwalMengajar;
use App\Models\Kelas;
use Livewire\Component;

class JadwalIndex extends Component
{
    public $title = 'Jadwal', $jadwal;
    public $selectedKelasId;
    public $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

    public function mount()
    {
        $this->jadwal = JadwalMengajar::orderBy('kelas_id')->orderBy('hari')->orderBy('jam_ke')->get();
        // dd($this->jadwal);
        $this->selectedKelasId = Kelas::first()?->id;
    }

    public function render()
    {

        $kelasList = Kelas::all();
        $jadwals = JadwalMengajar::with(['mapel', 'guru',])
            ->where('kelas_id', $this->selectedKelasId)
            ->orderBy('hari')
            ->orderBy('jam_ke')
            ->get()
            ->groupBy('hari');

        return view('livewire.jadwal-index', [
            'kelasList' => $kelasList,
            'jadwals' => $jadwals
        ])->layout('components.layouts.app', ['title' => $this->title]);
    }
}
