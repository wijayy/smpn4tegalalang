<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminCreate extends Component
{
    public $name, $email, $password, $role = 'admin', $force_reset_password = true, $id, $title;

    #[On('createModal')]
    public function openCreateModal()
    {
        // dd($this->id);
        $this->resetValidation();
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'admin';
        $this->force_reset_password = true;
        $this->title = 'Tambah Admin';
        $this->dispatch('modal-show', name: "tambah-admin");
    }

    #[On('editModal')]
    public function openEditModal($id)
    {
        $this->resetValidation();
        $user = User::where('id', $id)->first();
        if ($user) {
            $this->id = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->force_reset_password = $user->force_reset_password;
            $this->title = "Ubah Admin $user->name";
            $this->dispatch('modal-show', name: "tambah-admin");
        } else {
            session()->flash('error', "Data tidak ditemukan");
        }
    }

    public function save()
    {
        $validated = $this->validate(User::rules($this->id));

        try {
            DB::beginTransaction();

            $user = User::updateOrCreate(['id' => $this->id], $validated);
            if (!$this->id) {
                event(new Registered($user));
            }
            DB::commit();
            $this->dispatch('updateAdmin');
            session()->flash('success', "Data berhasil disimpan");
            $this->dispatch('modal-close', name: "tambah-admin");
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
        return view('livewire.admin-create');
    }
}
