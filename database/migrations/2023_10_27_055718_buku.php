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
        Schema::create('buku',function(Blueprint $table){
            $table->string('id_buku',15)->primary();
            $table->string('cover',125);
            $table->string('qrcode');
            $table->text('sinopsis');
            $table->string('nama_buku',50);
            $table->string('penerbit',25);
            $table->string('penulis',25);
            $table->mediumInteger('tahun_terbit');
            $table->enum('status_buku',['Dipinjam','Rusak','Tersedia']);
            $table->string('id_kategori',25);
            $table->integer('totalpeminjaman');

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
        Schema::dropIfExists('buku');
    }
};
