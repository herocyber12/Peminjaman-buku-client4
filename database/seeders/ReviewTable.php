<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('review')->delete();

        DB::table('review')->insert(
        [
            'id_review' => 'ID-R4567P',
            'rate'=> '4',
            'komentar' => 'biasa saja',
            'id_profil'=> 'ID-P4235D',
            'id_buku' => 'ID-B4565K'
        ]);
    }
}
