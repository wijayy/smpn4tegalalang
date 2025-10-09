<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    /** @use HasFactory<\Database\Factories\PrestasiSiswaFactory> */
    use HasFactory;
    protected $guarded = ['id'];
}
