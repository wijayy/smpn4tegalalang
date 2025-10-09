<?php

namespace App\Livewire;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class KelasCreate extends Component
{
    public $title, $guru;
    public $id;

    #[Validate('required')]
    public $nama = '', $tingkat = '', $guru_id = '';

    #[On('createModal')]
    public function openCreateModal()
    {
        $this->resetValidation();

        $this->id = null;
        $this->nama = '';
        $this->tingkat = '';
        $this->guru_id = '';
        $this->title = 'Tambah Kelas';

        $this->dispatch('modal-show', name: "tambah-kelas");
    }

    #[On('editModal')]
    public function openEditModal($id)
    {
        $kelas = Kelas::where('id', $id)->first();
        if ($kelas) {
            $this->resetValidation();

            $this->id = $kelas->id;
            $this->nama = $kelas->nama;
            $this->tingkat = $kelas->tingkat;
            $this->guru_id = $kelas->guru_id;
            $this->title = "Ubah Kelas $kelas->nama";
        }
        $this->dispatch('modal-show', name: "tambah-kelas");
    }

    public function save()
    {
        $validated = $this->validate();

        try {
            DB::beginTransaction();

            Kelas::updateOrCreate(['id' => $this->id], $validated);

            DB::commit();
            $this->dispatch('updateKelas');
            session()->flash('success', "Data berhasil disimpan");
            $this->dispatch('modal-close', name: "tambah-kelas");
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug') == true) {
                throw $th;
            } else {
                session()->flash('error', $th->getMessage());
            }
        }
    }

    public function mount() {
        $this->guru = Guru::get();
    }

    public function render()
    {
        return view('livewire.kelas-create');
    }
}
