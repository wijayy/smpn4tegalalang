<?php

namespace App\Livewire\Import;

use Livewire\Component;
use App\Imports\GuruImport;
use App\Imports\SiswaImport;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Siswa extends Component
{

    use WithFileUploads;

    public $file;

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new SiswaImport, $this->file->getRealPath());

        session()->flash('message', 'Data berhasil diimport!');
    }
    public function render()
    {
        return view('livewire.import.siswa');
    }
}
