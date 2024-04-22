<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite', function (Blueprint $table) {
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('annonce_id');
            $table->primary(['user_id','annonce_id']);
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('annonce_id')->references('id')->on('annonce')
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
        Schema::dropIfExists('favorite');
    }
}
