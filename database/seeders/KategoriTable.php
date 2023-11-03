<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->delete();

        DB::table('kategori')->insert(
        [
            'id_kategori' => 'ID-K4235D',
            'kategori'=> 'Pendidikan',
        ],
        [
            'id_kategori' => 'ID-K6273E',
            'kategori' => 'umum',
        ]);
    }
}
