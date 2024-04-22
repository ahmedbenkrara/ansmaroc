<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnonceImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonce_images', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->unsignedInteger('annonce_id');
            $table->foreign('annonce_id')
                  ->references('id')
                  ->on('annonce')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('annonce_images');
    }
}
