<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukuExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID Buku',
            'Nama Buku',
            'Penerbit',
            'Penulis',
            'Tahun Terbit',
            'Status Buku',
            'Kategori',
            'Total Peminjam'

        ];
    }

    public function collection()
    {
        return Buku::select('id_buku','nama_buku','penerbit','penulis','tahun_terbit','status_buku','id_kategori','totalpeminjaman')->get();
    }
}
