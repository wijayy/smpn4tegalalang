<?php

namespace App\Livewire\Import;

use Livewire\Component;
use App\Imports\AdminImport;
use App\Imports\GuruImport;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Guru extends Component
{

    use WithFileUploads;

    public $file;

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new GuruImport, $this->file->getRealPath());

        session()->flash('message', 'Data berhasil diimport!');
    }
    public function render()
    {
        return view('livewire.import.guru');
    }
}
