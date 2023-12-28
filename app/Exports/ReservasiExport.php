<?php

namespace App\Exports;

use App\Models\Reservasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReservasiExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID Reservasi',
            'Tanggal Dipinjam',
            'Tanggal Dikembalikan',
            'Status Reservasi',
            'Status Peminjaman',
            'Nama Peminjam Buku',
            'Nama Buku'

        ];
    }

    public function collection()
    {
        return Reservasi::join('buku', 'reservasi.id_buku', '=', 'buku.id_buku')
        ->join('profil', 'reservasi.id_profil', '=', 'profil.id_profil')
        ->select('reservasi.id_reservasi','reservasi.tanggal_dipinjam','reservasi.tanggal_dikembalikan','reservasi.status_reservasi','reservasi.status_peminjaman', 'buku.nama_buku', 'profil.nama as nama_akun')
        ->get();
    }
}
