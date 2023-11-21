<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TamuTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tamu')->delete();
        
        DB::table('tamu')->insert([
            'nama' => 'heroes',
            'asal' => 'SDN 3 Bumirejo'
        ]);
    }
}
