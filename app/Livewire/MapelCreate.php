<?php

namespace App\Livewire;

use App\Models\Mapel;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class MapelCreate extends Component
{
    #[Validate('required')]
    public $nama = '', $kode = '', $jumlah_jam = '';
    public $title = 'Tambah Mapel', $id;

    #[On('createModal')]
    public function openCreateModal()
    {
        $this->resetValidation();
        $this->id = null;
        $this->nama = '';
        $this->kode = '';
        $this->jumlah_jam = '';
        $this->dispatch('modal-show', name: "tambah-mapel");
    }

    #[On('editModal')]
    public function openEditModal($id)
    {
        $mapel = Mapel::where('id', $id)->first();
        if ($mapel) {
            $this->resetValidation();
            $this->id = $mapel->id;
            $this->nama = $mapel->nama;
            $this->kode = $mapel->kode;
            $this->jumlah_jam = $mapel->jumlah_jam;
            $this->title = "Ubah Mapel $mapel->nama";
        }
        $this->dispatch('modal-show', name: "tambah-mapel");
    }


    public function save()
    {
        $validated = $this->validate();
        try {
            DB::beginTransaction();
            Mapel::updateOrCreate(['id' => $this->id], $validated);
            DB::commit();
            $this->dispatch('updateMapel');
            session()->flash('success', "Data berhasil disimpan");
            $this->dispatch('modal-close', name: "tambah-mapel");
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
        return view('livewire.mapel-create');
    }
}
