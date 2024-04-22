<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouscatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('souscat', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('categorie_id');
            $table->foreign('categorie_id')
            ->references('id')
            ->on('categorie')
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
        Schema::dropIfExists('souscat');
    }
}
