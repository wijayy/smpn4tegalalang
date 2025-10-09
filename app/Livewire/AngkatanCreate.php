<?php

namespace App\Livewire;

use App\Models\Angkatan;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AngkatanCreate extends Component
{
    #[Validate('required')]
    public $tahun_mulai = '';

    #[Validate('required')]
    public $tahun_selesai = '';

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            Angkatan::create([
                'tahun_mulai'=>$this->tahun_mulai,
                'tahun_selesai'=>$this->tahun_selesai,
            ]);
            DB::commit();
            return redirect(route('angkatan.index'))->with('success', "Angkatan berhasil ditambahkan");
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
        return view('livewire.angkatan-create')->layout('components.layouts.app', ['title' => "Tambah Angkatan"]);
    }
}
