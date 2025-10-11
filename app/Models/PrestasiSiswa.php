<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestasiSiswa extends Model
{
    /** @use HasFactory<\Database\Factories\PrestasiSiswaFactory> */
    use HasFactory;
    protected $guarded = ['id'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function scopeFilters($query, array $filters)
    {
        $query->when($filters['siswa'] ?? false, function ($query, $search) {
            return $query->whereHas('siswa.user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['prestasi'] ?? false, function ($query, $search) {
            return $query->where('nama_prestasi', 'like', '%' . $search . '%');
        });

        $query->when($filters['tingkat'] ?? false, function ($query, $search) {
            return $query->where('tingkat', $search);
        });

        $query->when($filters['tahun'] ?? false, function ($query, $search) {
            return $query->where('tahun', 'like', '%' . $search . '%');
        });
    }



}
