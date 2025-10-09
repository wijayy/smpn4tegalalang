<?php

namespace App\Livewire;

use App\Models\Angkatan;
use Livewire\Component;

class AngkatanIndex extends Component
{
    public $angkatan;

    public function mount() {
        $this->angkatan = Angkatan::orderByDesc('tahun_selesai')->get();
    }


    public function render()
    {
        return view('livewire.angkatan-index')->layout('components.layouts.app', ['title'=>"Angkatan"]);
    }
}
