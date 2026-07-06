<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihans';

    protected $primaryKey = 'id_tagihan';

    public $incrementing = true;

    protected $fillable = [
        'nama_tagihan',
        'jatuh_tempo',
        'nis',
    ];

    /**
     * Relasi ke tabel siswa
     * tagihans.nis -> siswas.nis
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    /**
     * Relasi ke detail tagihan
     * Satu tagihan memiliki satu detail tagihan
     */
    public function detailTagihan()
    {
        return $this->hasOne(
            DetailTagihan::class,
            'id_tagihan',
            'id_tagihan'
        );
    }
}