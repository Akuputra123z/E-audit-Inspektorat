<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendations extends Model
{
    protected $table = 'recommendations';

    protected $fillable = [
        'lhp_id',
        'kode_temuan_id',
        'kode_rekom_id',
        'status',
        'uraian_rekom',
        'nilai_rekom',
        'uraian_temuan',
        'nilai_temuan',
        'no_tindak_lanjut',
        'uraian_tindak_lanjut',
        'nilai_tindak_lanjut',
        'file_tindak_lanjut',
        'tanggapan',
    ];

    protected $casts = [
        'file_tindak_lanjut' => 'array',
        'nilai_rekom' => 'decimal:2',
        'nilai_temuan' => 'decimal:2',
        'nilai_tindak_lanjut' => 'decimal:2',
    ];

    /** RELASI */
    public function lhp()
    {
        return $this->belongsTo(Lhp::class, 'lhp_id');
    }

    public function kodeRekomendasi()
{
    return $this->belongsTo(KodeRekomendasi::class, 'kode_rekom_id');
}
    public function kodeTemuan()
    {
        return $this->belongsTo(KodeTemuan::class, 'kode_temuan_id');
    }

    public function kodeRekom()
    {
        return $this->belongsTo(KodeRekomendasi::class, 'kode_rekom_id');
    }
}
