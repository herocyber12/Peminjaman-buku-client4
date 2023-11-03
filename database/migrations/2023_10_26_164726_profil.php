<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('profil', function (Blueprint $table) {
            $table->string('id_profil',15)->primary();
            $table->string('nama', 50);
            $table->string('alamat', 75);
            $table->bigInteger('no_hp');
            $table->enum('level',['Member','Admin'])->default('Member');
            $table->string('qrcode')->nullable();
            $table->string('foto', 50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('profil');
    }
};

