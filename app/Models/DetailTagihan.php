<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTagihan extends Model
{
    use HasFactory;

    protected $table = 'detail_tagihans';

    protected $primaryKey = 'id_detail';

    public $incrementing = true;

    protected $fillable = [
        'id_tagihan',
        'id_siswa',
        'nama_iuran',
        'jumlah_bayar',
        'status_tagihan',
        'bukti_bayar',
    ];

    /**
     * Relasi ke Tagihan
     * detail_tagihans.id_tagihan -> tagihans.id_tagihan
     */
    public function tagihan()
    {
        return $this->belongsTo(
            Tagihan::class,
            'id_tagihan',
            'id_tagihan'
        );
    }

    /**
     * Relasi ke Siswa
     * detail_tagihans.id_siswa -> siswas.id
     */
    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'id_siswa',
            'id'
        );
    }

    /**
     * Relasi ke Pembayaran
     */
    public function pembayaran()
    {
        return $this->hasMany(
            Pembayaran::class,
            'id_detail',
            'id_detail'
        );
    }

    /**
     * Total pembayaran yang sudah masuk
     */
    public function getTotalDibayarAttribute()
    {
        return $this->pembayaran()->sum('jumlah_bayar');
    }

    /**
     * Sisa tagihan
     */
    public function getSisaTagihanAttribute()
    {
        return max(
            0,
            $this->jumlah_bayar - $this->total_dibayar
        );
    }
}