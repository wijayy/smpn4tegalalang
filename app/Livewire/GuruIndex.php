<?php

namespace App\Livewire;

use App\Models\Guru;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class GuruIndex extends Component
{

    public $guru;

    #[Url(except: null)]
    public $search;

    #[On('updateGuru')]
    public function updateGuru()
    {
        $this->guru = Guru::filters(['search' => $this->search])->get();
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
        $this->guru = Guru::filters(['search' => $this->search])->get();
    }
    public function render()
    {
        return view('livewire.guru-index')->layout('components.layouts.app', ['title' => "Data Guru"]);
    }
}
