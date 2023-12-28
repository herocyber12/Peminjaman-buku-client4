<?php

namespace App\Exports;

use App\Models\Profil;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProfilExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function headings(): array
    {
        return [
            'ID PROFIL',
            'Nama',
            'Alamat',
            'Nomor Hp',

        ];
    }

    public function collection()
    {
        return Profil::select('id_profil','nama','alamat','no_hp')->get();
    }
}
