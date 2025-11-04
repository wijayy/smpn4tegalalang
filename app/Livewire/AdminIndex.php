<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class AdminIndex extends Component
{
    public $title = 'Data Admin', $admins;

    #[Url(except: '')]
    public $search = '';

    #[On('updateAdmin')]
    public function updateAdmin()
    {
        $this->admins = User::filters(['search' => $this->search])->where('role', 'admin')->get();
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
        $user = User::where('id', $id)->first();
        if ($user->isNot(Auth::user())) {
            $user->delete();
            $this->updateAdmin();
            session()->flash('success', "Data berhasil dihapus");
        } else {
            // dd('error');
            session()->flash('error', "Data tidak dapat dihapus");
        }
        $this->dispatch('modal-close', name: "delete-$id");
    }


    public function mount()
    {
        $this->updateAdmin();
    }

    public function render()
    {
        return view('livewire.admin-index')->layout('components.layouts.app', ['title' => $this->title]);
    }
}
