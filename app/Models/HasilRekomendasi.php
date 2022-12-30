<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilRekomendasi extends Model
{
    use HasFactory;

    protected $fillable = ['id_tahun_akademik', 'jenis_file', 'file'];
}
