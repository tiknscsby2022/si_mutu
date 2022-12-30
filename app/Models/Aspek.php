<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspek extends Model
{
    use HasFactory;

    protected $fillable = ['aspek'];

    public function standars() {
        return $this->hasMany(Standar::class, 'id_aspek');
    }
}
