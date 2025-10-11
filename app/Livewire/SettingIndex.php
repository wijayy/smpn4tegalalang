<?php

namespace App\Livewire;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SettingIndex extends Component
{

    public $title = 'Konfigurasi Sistem';


    #[Validate('required')]
    public $default_guru_password = '';
    #[Validate('required')]
    public $default_siswa_password = '';

    public function mount()
    {
        $this->default_guru_password = Setting::where('key', 'default_guru_password')->value('value');
        $this->default_siswa_password = Setting::where('key', 'default_siswa_password')->value('value');
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            Setting::updateOrCreate(['key' => 'default_guru_password'], ['value' => $this->default_guru_password]);
            Setting::updateOrCreate(['key' => 'default_siswa_password'], ['value' => $this->default_siswa_password]);
            DB::commit();
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
        return view('livewire.setting-index')->layout('components.layouts.app', ['title' => $this->title]);
    }
}
