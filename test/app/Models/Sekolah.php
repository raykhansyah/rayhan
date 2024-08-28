<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'kode_unik',
        'alamat',
        'jenis_kelamin',
        'email', 
    ];
    
}
