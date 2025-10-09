<?php

namespace App\Livewire;

use App\Models\Siswa;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SiswaCreate extends Component
{
    public $title, $guru;
    public $id;

    #[Validate('required')]
    public $nama = '', $nis, $nisn, $alamat, $no_telp, $jenis_kelamin, $angkatan_id = '', $siswa_tidak_mampu = false, $status = '';

    #[On('createModal')]
    public function openCreateModal()
    {
        $this->resetValidation();

        $this->id = null;
        $this->nama = '';
        $this->nis = '';
        $this->nisn = '';
        $this->alamat = '';
        $this->no_telp = '';
        $this->jenis_kelamin = '';
        $this->angkatan_id = '';
        $this->siswa_tidak_mampu = false;
        $this->status = '';
        $this->title = 'Tambah Siswa';

        $this->dispatch('modal-show', name: "tambah-siswa");
    }

    #[On('editModal')]
    public function openEditModal($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        if ($siswa) {
            $this->resetValidation();

            $this->id = $siswa->id;
            $this->nama = $siswa->nama;
            $this->nis = $siswa->nis;
            $this->nisn = $siswa->nisn;
            $this->alamat = $siswa->alamat;
            $this->no_telp = $siswa->no_telp;
            $this->jenis_kelamin = $siswa->jenis_kelamin;
            $this->angkatan_id = $siswa->angkatan_id;
            $this->siswa_tidak_mampu = $siswa->siswa_tidak_mampu;
            $this->status = $siswa->status;
            $this->title = "Ubah Siswa $siswa->nama";
        }
        $this->dispatch('modal-show', name: "tambah-siswa");
    }

    public function save()
    {
        $validated = $this->validate();

        try {
            DB::beginTransaction();
            Siswa::updateOrCreate(['id' => $this->id], $validated);
            DB::commit();
            $this->dispatch('updateSiswa');
            session()->flash('success', "Data berhasil disimpan");
            $this->dispatch('modal-close', name: "tambah-siswa");
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
        return view('livewire.siswa-create');
    }
}
