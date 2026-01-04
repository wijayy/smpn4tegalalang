<?php

namespace App\Livewire;

use App\Models\PrestasiSiswa;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class PrestasiIndex extends Component
{
    public $title = 'Prestasi Siswa', $tingkat_prestasi = ['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'], $filter = false;

    #[Url(except: '')]
    public $siswa = '', $prestasi = '', $tingkat = '', $tahun = '';

    public $prestasis;

    #[On('updatePrestasi')]
    public function updatePrestasi()
    {
        $this->prestasis = PrestasiSiswa::filters(['siswa' => $this->siswa, 'prestasi' => $this->prestasi, 'tingkat' => $this->tingkat, 'tahun' => $this->tahun])->get();

        // dd($this->prestasis);
    }

    public function updated($property, $value)
    // public function updated($property)
    {
        // dd($this->siswa);
        $this->updatePrestasi();
    }


    public function openCreateModal()
    {
        $this->dispatch('createModal');
    }

    public function openEditModal($id)
    {
        $this->dispatch('editModal', ['id' => $id]);
    }

    public function toogleFilter()
    {
        $this->filter = !$this->filter;
    }

    public function resetFilter()
    {
        $this->siswa = '';
        $this->prestasi = '';
        $this->tingkat = '';
        $this->tahun = '';
        $this->updatePrestasi();
    }


    public function mount()
    {
        $this->updatePrestasi();
    }

    public function render()
    {
        return view('livewire.prestasi-index')->layout('components.layouts.app', ['title' => $this->title]);
    }
}
