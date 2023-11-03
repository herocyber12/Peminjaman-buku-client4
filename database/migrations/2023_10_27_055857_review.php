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
        Schema::create('review', function(Blueprint $table){
            $table->string('id_review',15)->primary();
            $table->enum('rate',['1','2','3','4','5']);
            $table->text('komentar')->nullable();
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
        //
    }
};
