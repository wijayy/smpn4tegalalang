<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    /** @use HasFactory<\Database\Factories\SiswaFactory> */
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
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function getNameAttribute()
    {
        return $this->user ? $this->user->name : null;
    }

    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);

    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prestasi() {
        return $this->hasMany(PrestasiSiswa::class);
    }

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }


    public function scopeFilters($query, array $filters)
    {
        $query->when($filters['kelas'] ?? false, function ($query, $search) {
            return $query->whereHas('kelas', function ($query) use ($search) {
                $query->where('nama', $search);
            });
        });
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->orWhere('nis', 'like', '%' . $search . '%')
                ->orWhere('nisn', 'like', '%' . $search . '%');
        });


    }


}
