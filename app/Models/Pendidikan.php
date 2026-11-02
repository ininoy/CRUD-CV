<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_1152';
    protected $fillable = ['biodata_id', 'nama_instansi', 'keterangan', 'tahun'];

    public function biodata()
    {
        return $this->belongsTo(Biodata::class, 'biodata_id');
    }
}
