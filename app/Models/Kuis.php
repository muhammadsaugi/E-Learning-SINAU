<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $table = 'kuis';

    protected $fillable = [
        'kelas_id',
        'judul',
        'durasi_menit',
        'passing_grade',
    ];

    /**
     * Relasi ke Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    /**
     * Relasi ke Butir Soal
     */
    public function soal()
    {
        return $this->hasMany(Soal::class, 'kuis_id');
    }

    /**
     * Relasi ke Nilai Siswa
     */
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'kuis_id');
    }
}
