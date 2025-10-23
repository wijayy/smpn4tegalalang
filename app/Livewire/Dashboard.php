<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $title = 'Dashboard';
    public $activeStudents, $activeTeachers, $totalClasses, $totalPrestasi, $lastPrestasi;

    public function mount()
    {
        $this->activeStudents = \App\Models\Siswa::count();
        $this->activeTeachers = \App\Models\Guru::count();
        $this->totalClasses = \App\Models\Kelas::count();
        $this->totalPrestasi = \App\Models\PrestasiSiswa::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();

        $this->lastPrestasi = \App\Models\PrestasiSiswa::with('siswa')->latest()->take(8)->get();
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('components.layouts.app', ['title' => $this->title]);
    }
}