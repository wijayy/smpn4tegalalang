<?php

namespace App\Livewire;

use App\Models\Kelas;
use Livewire\Attributes\On;
use Livewire\Component;

class KelasIndex extends Component
{
    public $kelas;

    #[On('updateKelas')]
    public function updateKelas()
    {
        $this->kelas = Kelas::get();
    }

    public function openCreateModal()
    {
        $this->dispatch('createModal');
    }
    public function openEditModal($id)
    {
        $this->dispatch('editModal', id: $id);
    }
    public function mount()
    {
        $this->updateKelas();
    }

    public function delete($id) {
        $kelas = Kelas::where('id', $id)->first();
        if ($kelas) {
            $kelas->delete();
            $this->updateKelas();
            session()->flash('success', "Data berhasil dihapus");
        } else {
            session()->flash('error', "Data tidak ditemukan");
        }
    }


    public function render()
    {
        return view('livewire.kelas-index')->layout('components.layouts.app', ['title' => "Data Kelas"]);
    }
}
