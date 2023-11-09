<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservasi',function(Blueprint $table){
            $table->string('id_reservasi',15)->primary();
            $table->date('tanggal_dipinjam')->nullable();
            $table->date('tanggal_dikembalikan')->nullable();
            $table->enum('status_reservasi',['Masih Dipinjam','Sudah Dikembalikan','Pengajuan Peminjaman']);
            $table->enum('status_peminjaman',['Disetujui','Belum Disetujui','Tidak Di Setujui']);
            $table->string('id_profil',15);
            $table->string('id_buku',15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasi');
    }
};
