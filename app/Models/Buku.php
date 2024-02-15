<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table='buku';
    protected $fillable = [
        'id_buku',
        'cover',
        'sinopsis',
        'nama_buku',
        'penerbit',
        'penulis',
        'tahun_terbit',
        'status_buku',
        'jumlah_buku',
        'id_kategori',
        'rak',
        'totalpeminjaman'
    ];
}
