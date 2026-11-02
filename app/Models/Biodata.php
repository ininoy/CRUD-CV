<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata_1152';

    protected $fillable = [
        'nim', 'nama', 'jurusan_kelas', 'email', 'telepon', 'alamat', 'tentang_saya', 'foto'
    ];

    public function pendidikans()
    {
        return $this->hasMany(Pendidikan::class, 'biodata_id');
    }
}
