<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    /** @use HasFactory<\Database\Factories\KelasFactory> */
    use HasFactory, Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama',
                'onUpdate' => true
            ]
        ];
    }
    protected $guarded = ['id'];

    public function wali() {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

        // Relasi ke tabel pivot
    public function kelasSiswa()
    {
        return $this->hasMany(SiswaKelas::class, 'kelas_id');
    }

    // Relasi many-to-many ke siswa
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'siswa_kelas', 'kelas_id', 'siswa_id');
    }
}
