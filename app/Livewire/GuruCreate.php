<?php

namespace App\Livewire;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class GuruCreate extends Component
{

    public $mapels, $users, $title, $id;

    #[Validate('required')]
    public $nama, $kode, $alamat, $no_telp;

    #[Validate('nullable')]
    public $no_pegawai = '', $mapel_id;

    #[On('createModal')]
    public function openCreateModal()
    {

        $this->resetValidation();

        $this->id = null;
        $this->nama = '';
        $this->kode = '';
        $this->alamat = '';
        $this->no_telp = '';
        $this->no_pegawai = '';
        $this->mapel_id = '';
        $this->title = 'Tambah Guru';

        $this->dispatch('modal-show', name: "tambah-guru");

    }

    #[On('editModal')]
    public function openEditModal($id)
    {
        $guru = Guru::where('id', $id)->first();

        if ($guru) {
            $this->resetValidation();

            $this->id = $guru->id;
            $this->nama = $guru->nama;
            $this->kode = $guru->kode;
            $this->alamat = $guru->alamat;
            $this->no_telp = $guru->no_telp;
            $this->no_pegawai = $guru->no_pegawai;
            $this->mapel_id = $guru->mapel_id;
            $this->title = "Ubah Guru $guru->nama";
        }
        $this->dispatch('modal-show', name: "tambah-guru");
    }

    public function mount()
    {
        $this->mapels = Mapel::get();
        $this->users = User::where('role', 'guru')->get();
    }

    public function save()
    {
        $validated = $this->validate();

        try {
            DB::beginTransaction();
            Guru::updateOrCreate(['id' => $this->id], $validated);
            DB::commit();
            $this->dispatch('updateGuru');
            session()->flash('success', "Data berhasil disimpan");
            $this->dispatch('modal-close', name: "tambah-guru");
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
        return view('livewire.guru-create');
    }
}
