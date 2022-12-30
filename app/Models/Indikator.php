<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory;

    protected $fillable = ['id_standar', 'id_tahun_akademik', 'indikator', 'value', 'pic'];
    
    public function realisasi(){
        return $this->hasOne(Realisasi::class, 'id_indikator');
    }
}
