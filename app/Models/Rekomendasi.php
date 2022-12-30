<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;
    protected $fillable = ['id_realisasi', 'rekomendasi'];

    public function hasil_rekomendasi(){
        return $this->hasOne(HasilRekomendasi::class, 'id_rekomendasi');
    }
}
