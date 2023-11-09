<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kegiatan')->delete();

        DB::table('kegiatan')->insert([
            'banner' => 'tex.jpg',
            'nama_kegiatan' => 'Ini nyoba aja sih'

        ]);
    }
}
