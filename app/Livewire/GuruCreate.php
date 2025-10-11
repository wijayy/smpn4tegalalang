<?php

namespace App\Livewire;

use App\Models\Guru;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Setting;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruCreate extends Component
{

    public $mapels, $users, $title, $id, $user_id;

    #[Validate('required')]
    public $kode, $alamat, $no_telp, $name, $role = 'guru';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('nullable')]
    public $no_pegawai = '', $mapel_id;

    #[On('createModal')]
    public function openCreateModal()
    {

        $this->resetValidation();

        $this->id = null;
        $this->name = '';
        $this->email = '';
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
            $this->user_id = $guru->user_id;
            $this->name = $guru->name;
            $this->email = $guru->user->email;
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
    }

    public function save()
    {

        try {
            $validated = $this->validate();
            DB::beginTransaction();

            if ($this->id) {
                $user = User::where('id', $this->user_id)->first();
                $user->fill($validated);

                if ($user->isDirty('email')) {
                    $user->email_verified_at = null;
                }

                $user->save();
            } else {
                $password = Hash::make(Setting::where('key', 'default_guru_password')->value('value'));

                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => $password,
                    'role' => $this->role,
                ]);
                $validated['user_id'] = $user->id;
            }

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
