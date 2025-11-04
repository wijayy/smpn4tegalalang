<?php

namespace App\Livewire\Import;

use App\Imports\AdminImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Admin extends Component
{

    use WithFileUploads;

    public $file;

    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new AdminImport, $this->file->getRealPath());

        session()->flash('message', 'Data berhasil diimport!');
    }

    public function render()
    {
        return view('livewire.import.admin');
    }
}
