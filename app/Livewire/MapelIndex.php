<?php

namespace App\Livewire;

use App\Models\Mapel;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Component;

class MapelIndex extends Component
{

    public $title = 'Data Mapel', $mapels;

    #[On('updateMapel')]
    public function updateMapel()
    {
        $this->mapels = Mapel::get();
    }

    public function mount()
    {
        $this->updateMapel();
    }

    public function openCreateModal()
    {
        $this->dispatch('createModal');
    }

    public function openEditModal($id)
    {
        $this->dispatch('editModal', id: $id);
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            Mapel::where('id', $id)->delete();
            DB::commit();
            $this->updateMapel();
            session()->flash('success', "Data berhasil dihapus");
            $this->dispatch('modal-close', name: "delete-$id");
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
        return view('livewire.mapel-index')->layout('components.layouts.app', ['title' => $this->title]);
    }
}
