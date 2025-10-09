<?php

namespace App\Livewire;

use App\Models\Siswa;
use Livewire\Attributes\On;
use Livewire\Component;

class SiswaIndex extends Component
{
    public $siswa;
    #[On('updateSiswa')]
    public function updateSiswa()
    {
        $this->siswa = Siswa::get();
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
        $this->updateSiswa();
    }
    public function delete($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        if ($siswa) {
            $siswa->delete();
            $this->updateSiswa();
            session()->flash('success', "Data berhasil dihapus");
        } else {
            session()->flash('error', "Data tidak ditemukan");
        }
    }

    public function render()
    {
        return view('livewire.siswa-index')->layout('components.layouts.app', ['title' => "Data Siswa"]);
    }
}
