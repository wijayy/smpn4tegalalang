<?php

namespace App\Livewire;

use App\Models\Kelas;
use App\Models\Siswa;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class SiswaIndex extends Component
{
    public $show = false;

    #[Url(except: '')]
    public $search = '', $kelas = '', $tanggal_lahir = '';

    public $kelass;

    public function updatedSearch()
    {
        $this->updateSiswa();
    }

    public function updatedKelas()
    {
        $this->updateSiswa();
    }

    public function updatedTanggalLahir()
    {
        $this->updateSiswa();
    }

    public $siswa;

    // protected $listeners = ['updateSiswa' => '$refresh'];

    #[On('updateSiswa')]
    public function updateSiswa()
    {
        if (($this->search == '') && ($this->kelas == '') && ($this->tanggal_lahir == '')) {
            $this->kelas = $this->kelass->first()->nama;
        }
        $this->siswa = Siswa::filters(['search' => $this->search, 'kelas' => $this->kelas, 'tanggal_lahir' => $this->tanggal_lahir])->get();
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

        $this->kelass = Kelas::get();

        // $this->kelas = $this->kelas == "" ? $this->kelass->first()->nama : $this->kelas;
        $this->updateSiswa();



        // dd($this->siswa);
    }
    public function delete($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        $siswa_id = $siswa->id;
        if ($siswa) {
            $siswa->delete();
            $this->updateSiswa();
            session()->flash('success', "Data berhasil dihapus");
        } else {
            session()->flash('error', "Data tidak ditemukan");
        }
        $this->dispatch('modal-close', name: "delete-$siswa_id");
    }

    public function render()
    {
        return view('livewire.siswa-index')->layout('components.layouts.app', ['title' => "Data Siswa"]);
    }
}
