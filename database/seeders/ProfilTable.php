<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profil')->delete();

        DB::table('profil')->insert([
            'id_profil' => 'ID-P4235D',
            'nama' => 'aspwe',
            'alamat'=> 'mars',
            'no_hp' => '08327367262',
            'qrcode'=>'ini qrcode',
            'level'=> 'Member',
            'foto' => 'Anjas.jpg',
            
        ]);

        DB::table('profil')->insert([
            'id_profil' => 'ID-ID-P456542',
            'nama' => 'hehe',
            'alamat'=> 'pluto',
            'no_hp' => '08327367262',
            'qrcode'=>'ini qrcode',
            'level'=> 'Member',
            'foto' => 'Anjas.jpg',
        ]);
    }
}
