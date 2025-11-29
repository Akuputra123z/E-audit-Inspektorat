<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitDiperiksa extends Model
{
    use HasFactory;

    protected $table = 'unit_diperiksa';

    protected $fillable = [
        'nama_unit',
        'kategori',
        'nama_kecamatan',
    ];

    public function lhp()
    {
        return $this->hasMany(Lhp::class, 'unit_id');
    }
}
