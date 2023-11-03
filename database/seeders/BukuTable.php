<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buku')->delete();
        DB::table('buku')->insert([
            'id_buku'=>"ID-B4565K",
            'cover'=>'cover.jpg',
            'qrcode' => '565dvbj',
            'sinopsis'=>'ini sinopsis',
            'nama_buku'=>'kiko',
            'penerbit' => 'sukuna',
            'penulis'=>'gojo',
            'tahun_terbit'=> 2009,
            'status_buku' => 'Dipinjam',
            'id_kategori'=>'ID-K4235D',
            'totalpeminjaman'=>3,
        ]);
    }
}
