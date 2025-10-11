<?php

namespace App\Livewire;

use App\Models\JadwalMengajar;
use Livewire\Component;

class JadwalIndex extends Component
{
    public $title = 'Jadwal', $jadwal;

    public function mount()
    {
        $this->jadwal = JadwalMengajar::orderBy('kelas_id')->orderBy('hari')->orderBy('jam_ke')->get();
        // dd($this->jadwal);
    }

    public function render()
    {
        return view('livewire.jadwal-index')->layout('components.layouts.app', ['title' => $this->title]);
    }
}
