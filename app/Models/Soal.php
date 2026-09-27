<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'kuis_id',
        'pertanyaan',
        'tipe',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'kunci_jawaban',
    ];

    /**
     * Relasi ke Kuis induk.
     */
    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'kuis_id');
    }
}
