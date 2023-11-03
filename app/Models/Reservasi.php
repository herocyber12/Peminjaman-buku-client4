<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;
    protected $table ='reservasi';
    protected $fillable = [
        'id_reservasi',
        'tanggal_dipinjam',
        'tanggal_dikembalikan',
        'status_reservasi',
        'status_peminjaman',
        'id_profil',
        'id_buku',
    ];
}
