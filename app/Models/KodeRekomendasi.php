<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KodeRekomendasi extends Model
{
    use HasFactory;

    protected $table = 'kode_rekomendasi';

    protected $fillable = [
        'kode',
        'kategori',
        'deskripsi',
    ];

    public function rekomendasi()
    {
        return $this->hasMany(Recommendations::class, 'kode_rekom_id');
    }
}
