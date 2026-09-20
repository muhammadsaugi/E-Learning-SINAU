<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'guru_id',
        'nama_kelas',
        'mata_pelajaran',
        'kode_kelas',
        'deskripsi',
    ];

    /**
     * Relasi ke Guru (User pengampu).
     */
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
