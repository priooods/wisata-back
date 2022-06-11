<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePariwisataDestinasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pariwisata_destinasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kota');
            $table->enum("categori",["Gunung","Pantai","Pulau","Taman","Museum","Hiburan","Cafe","Wahana Air","Budaya","Religi","Lainnya"]);
            $table->integer('rating')->default(0);
            $table->string('image_filename');
            $table->string('image_urls');
            $table->tinyInteger('status')->default(1)->comment("0 = show, 1 = hidden");
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
        Schema::dropIfExists('pariwisata_destinasis');
    }
}
