<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            //El usuario que creó el catálogo (owner)
            $table->unsignedInteger('user_id');
            //Constraints
            $table->smallInteger('cstr_privacy')->default(1);
            $table->smallInteger('cstr_restricted')->default(1);
            //Si el catálogo es colaborativo otro usuario puede 
            //agregar posts al catálogo
            $table->smallInteger('cstr_colaborative')->default(1);

            $table->foreign('user_id')
                        ->references('id')->on('users')
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
        Schema::dropIfExists('catalogs');
    }
}
