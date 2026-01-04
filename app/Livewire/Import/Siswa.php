<?php

namespace App\Livewire\Import;

use Livewire\Component;
use App\Imports\GuruImport;
use App\Imports\SiswaImport;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Siswa extends Component
{

    use WithFileUploads;

    #[Validate('required|mimes:xls,xlsx')]
    public $file;

    public function import()
    {
        $this->validate();

        Excel::import(new SiswaImport, $this->file->getRealPath());

        session()->flash('message', 'Data berhasil diimport!');
    }

    public function download()
    {
        return response()->download(
            'asset/template_import_data_siswa.xlsx'
        );
    }
    public function render()
    {
        return view('livewire.import.siswa')->layout('components.layouts.app', ['title' => 'Import Data Siswa']);
    }
}
