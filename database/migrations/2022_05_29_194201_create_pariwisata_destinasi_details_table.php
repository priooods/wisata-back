<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePariwisataDestinasiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pariwisata_destinasi_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('destinasi_id');
            $table->text('description');
            $table->string('lokasi');
            $table->integer('biaya_masuk')->default(0);
            $table->json('image_list')->nullable();
            $table->string('latitude');
            $table->string('longitude');
            $table->foreign('destinasi_id')->references('id')->on('pariwisata_destinasis')->onDelete('cascade');
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
        Schema::dropIfExists('pariwisata_destinasi_details');
    }
}
