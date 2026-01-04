<?php

namespace App\Livewire;

use App\Models\Angkatan;
use App\Models\Kelas;
use App\Models\Setting;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SiswaCreate extends Component
{
    public $title, $angkatan, $kelas;
    public $id, $user_id;

    #[Validate('required')]
    public $name = '', $nis, $nisn, $alamat, $no_telp, $jenis_kelamin, $angkatan_id = '', $siswa_tidak_mampu = false, $status = '', $kelas_id, $role = 'siswa', $tanggal_lahir;

    #[Validate('required|email')]
    public $email = '';

    #[On('createModal')]
    public function openCreateModal()
    {
        $this->resetValidation();

        $this->id = null;
        $this->user_id = null;
        $this->name = '';
        $this->email = '';
        $this->nis = '';
        $this->tanggal_lahir = '';
        $this->nisn = '';
        $this->alamat = '';
        $this->no_telp = '';
        $this->jenis_kelamin = 'L';
        $this->angkatan_id = '';
        $this->siswa_tidak_mampu = false;
        $this->status = '';
        $this->kelas_id = null;
        $this->title = 'Tambah Siswa';

        $this->dispatch('modal-show', name: "tambah-siswa");
    }

    #[On('editModal')]
    public function openEditModal($id)
    {
        $siswa = Siswa::where('id', $id)->first();
        // dd($siswa);
        if ($siswa) {
            $this->resetValidation();

            $this->id = $siswa->id;
            $this->user_id = $siswa->user_id;
            $this->name = $siswa->name;
            $this->email = $siswa->user->email;
            $this->nis = $siswa->nis;

            $this->tanggal_lahir = Carbon::parse($siswa->tanggal_lahir)->format('Y-m-d');
            // dd($this->tanggal_lahir);
            $this->nisn = $siswa->nisn;
            $this->alamat = $siswa->alamat;
            $this->no_telp = $siswa->no_telp;
            $this->jenis_kelamin = $siswa->jenis_kelamin;
            $this->angkatan_id = $siswa->angkatan_id;
            $this->siswa_tidak_mampu = $siswa->siswa_tidak_mampu;
            $this->status = $siswa->status;
            $this->kelas_id = $siswa->kelas->id;
            $this->title = "Ubah Siswa $siswa->name";
        }
        $this->dispatch('modal-show', name: "tambah-siswa");
    }

    public function mount()
    {
        $this->angkatan = Angkatan::get();
        $this->kelas = Kelas::get();
    }

    public function save()
    {
        $validated = $this->validate();
        // dd($validated);

        try {
            DB::beginTransaction();

            if ($this->id) {
                $user = User::where('id', $this->user_id)->first();
                $user->fill($validated);

                if ($user->isDirty('email')) {
                    $user->email_verified_at = null;
                }

                $user->save();
            } else {
                $password = Hash::make(Setting::where('key', 'default_siswa_password')->value('value'));

                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => $password,
                    'role' => $this->role,
                ]);
                $validated['user_id'] = $user->id;
            }

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
