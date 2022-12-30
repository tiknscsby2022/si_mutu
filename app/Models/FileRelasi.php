<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileRelasi extends Model
{
    use HasFactory;

    protected $fillable = ['id_realisasi', 'nama', 'file'];
}
