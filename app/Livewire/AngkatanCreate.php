<?php

namespace App\Livewire;

use App\Models\Angkatan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AngkatanCreate extends Component
{
    public $title = 'Tambah Angkatan';
    
    #[Validate('required')]
    public $tahun_mulai = '';

    #[Validate('required')]
    public $tahun_selesai = '';

    #[On('createModal')]
    public function openCreateModal()
    {
        $this->resetValidation();
        $this->tahun_mulai = '';
        $this->tahun_selesai = '';
        $this->dispatch('modal-show', name: "tambah-angkatan");
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            Angkatan::create([
                'tahun_mulai' => $this->tahun_mulai,
                'tahun_selesai' => $this->tahun_selesai,
            ]);
            DB::commit();
            $this->dispatch('updateAngkatan');
            session()->flash('success', "Data berhasil disimpan");
            $this->dispatch('modal-close', name: "tambah-angkatan");
        } catch (\Throwable $th) {
            DB::rollBack();
            if (config('app.debug') == true) {
                throw $th;
            } else {
                return back()->with('error', $th->getMessage());
            }
        }
    }
    public function render()
    {
        return view('livewire.angkatan-create')->layout('components.layouts.app', ['title' => $this->title]);
    }
}
