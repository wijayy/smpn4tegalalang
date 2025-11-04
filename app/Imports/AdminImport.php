<?php

namespace App\Imports;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class AdminImport implements ToModel, WithHeadingRow
{


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['nama'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'role' => 'admin',
            'force_reset_password' => true
        ]);
    }
}
