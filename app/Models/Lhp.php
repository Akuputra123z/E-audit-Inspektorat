<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lhp extends Model
{
    use HasFactory;

    protected $table = 'lhp';

    protected $fillable = [
        'nomor_lhp',
        'tanggal_lhp',
        'nama_kecamatan',
        'kategori_unit',
        'unit_id',
        'jenis_pemeriksaan',
        'tim',
    ];

    /**
     * Relasi ke unit yang diperiksa
     * contoh: Dinas Pendidikan / Desa Sidorejo / Bidang Anggaran / SDN 1 Rembang
     */
    public function unit()
    {
        return $this->belongsTo(UnitDiperiksa::class, 'unit_id');
    }

    /**
     * LHP memiliki banyak temuan
     */
    // public function temuan()
    // {
    //     return $this->hasMany(TemuanLhp::class, 'lhp_id');
    // }

    /**
     * LHP → Temuan → Recommendations
     * Relasi tidak langsung, tapi bisa dipanggil via temuan
     */
    // public function recommendations()
    // {
    //     return $this->hasManyThrough(
    //         Recommendations::class,   // tabel tujuan
    //         'lhp_id',                 // FK di tabel temuan_lhp
    //         'id',                     // PK LHP
            
    //     );
    // }

    public function recommendations()
    {
        return $this->hasMany(\App\Models\Recommendations::class, 'lhp_id', 'id');
    }
    
}
