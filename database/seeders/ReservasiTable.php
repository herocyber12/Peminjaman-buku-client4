<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservasiTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservasi')->delete();

        DB::table('reservasi')->insert([
            'id_reservasi' => 'ID-R5632D',
            'tanggal_dipinjam' => '2023-09-23',
            'tanggal_dikembalikan' => '2023-09-26',
            'status_reservasi' => 'Pengajuan Peminjaman',
            'status_peminjaman' => 'Belum Disetujui',
            'id_profil'=> 'ID-P4235D',
            'id_buku' => 'ID-B4565K'
        ]);
    }
}
