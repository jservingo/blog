<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url')->nullable();
            //El usuario que creó la página (owner)
            $table->unsignedInteger('user_id');
            //La app a la cual pertenece la página
            $table->unsignedInteger('app_id')->nullable();
            $table->smallInteger('featured')->default(0);
            $table->Integer('position')->default(9999);
            
            //Constraints
            $table->smallInteger('cstr_privacy')->default(1);
            $table->smallInteger('cstr_restricted')->default(1);            
            //Si una página es colaborativa otros usuarios pueden
            //agregar catálogos a la página
            $table->smallInteger('cstr_colaborative')->default(0);
            $table->smallInteger('cstr_allow_subscribers')->default(1);
            $table->smallInteger('cstr_show_subscribers')->default(1);
            $table->smallInteger('cstr_main_page')->default(0);
                        
            $table->foreign('user_id')
                        ->references('id')->on('users')
                        ->onDelete('cascade');

            $table->foreign('app_id')
                        ->references('id')->on('apps')
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
        Schema::dropIfExists('pages');
    }
}
