<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'username' => 'herocyber12',
            'email' => 'herocyber00@gmail.com',
            'password'=> Hash::make('123'),
            'id_profil' => 'ID-P4235D',
        ]);
    }
}
