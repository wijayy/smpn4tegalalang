<?php

namespace App\Livewire;

use App\Models\Angkatan;
use Livewire\Attributes\On;
use Livewire\Component;

class AngkatanIndex extends Component
{
    public $angkatan;

    #[On('updateAngkatan')]
    public function updateAngkatan(){
        $this->angkatan = Angkatan::orderByDesc('tahun_selesai')->get();

    }

    public function mount() {
        $this->updateAngkatan();
    }

    public function openCreateModal() {
        $this->dispatch('createModal');
    }


    public function render()
    {
        return view('livewire.angkatan-index')->layout('components.layouts.app', ['title'=>"Angkatan"]);
    }
}
