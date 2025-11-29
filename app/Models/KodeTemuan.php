<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeTemuan extends Model
{
    protected $table = 'kode_temuan';

    protected $fillable = [
        'kode',
        'kelompok',
        'sub_kelompok',
        'deskripsi',
    ];

    public function recommendations()
    {
        return $this->hasMany(Recommendations::class, 'kode_temuan_id');
    }
}
