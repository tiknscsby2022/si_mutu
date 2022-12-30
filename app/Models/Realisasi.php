<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    use HasFactory;
    
    protected $fillable = ['id_indikator', 'id_tahun_akademik', 'value', 'pic', 'file_tautan','status', 'alasan'];

    public function indikator(){
        return $this->belongsTo(Indikator::class, 'id_indikator');
    }

    public function file(){
        return $this->hasMany(FileRelasi::class);
    }

    public function rekomendasi(){
        return $this->hasOne(Rekomendasi::class, 'id_realisasi');
    }

    public function peningkatan(){
        return $this->hasOne(Peningkatan::class, 'id_realisasi');
    }
}
