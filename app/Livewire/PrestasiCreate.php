<?php

namespace App\Livewire;

use App\Models\PrestasiSiswa;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class PrestasiCreate extends Component
{

    #[Validate('required')]
    public $siswa_id = '', $nama_prestasi = '', $tingkat = '', $tahun = '';

    #[Validate('nullable')]
    public $keterangan = '';


    public $title = 'Tambah Prestasi Siswa', $siswa, $tingkat_prestasi = ['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'];

    #[On('createModal')]
    public function openCreateModal()
    {
        $this->resetValidation();

        $this->siswa_id = '';
        $this->nama_prestasi = '';
        $this->tingkat = '';
        $this->tahun = '';
        $this->keterangan = '';
        $this->title = 'Tambah Prestasi Siswa';

        $this->dispatch('modal-show', name: "tambah-prestasi");
    }

    public function mount()
    {
        $this->siswa = Siswa::get();
    }

    public function save()
    {

        try {
            // dd($false);
            $validated = $this->validate();
            DB::beginTransaction();
            PrestasiSiswa::create($validated);
            DB::commit();
            $this->dispatch('updatePrestasi');
            session()->flash('success', "Data berhasil disimpan");
            $this->dispatch('modal-close', name: "tambah-prestasi");
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug') == true) {
                throw $th;
            } else {
                session()->flash('error', $th->getMessage());
            }
        }
    }


    public function render()
    {
        return view('livewire.prestasi-create');
    }
}
