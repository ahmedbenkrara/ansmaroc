<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signale', function (Blueprint $table) {
            $table->id();
            $table->text('description');
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
        Schema::dropIfExists('signale');
    }
}
