<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnonceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonce', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description');
            $table->float('prix');
            $table->string('ville');
            //demande(0) ou vente(1)
            $table->integer('type');
            //unaccepted(0) ou accepted(1)
            $table->integer('status');
            $table->text('adresse');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('souscat_id');
            $table->string('phone')->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->foreign('souscat_id')
                  ->references('id')
                  ->on('souscat')
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
        Schema::dropIfExists('annonce');
    }
}
