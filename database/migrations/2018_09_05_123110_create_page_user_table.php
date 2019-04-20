<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('page_id');
            $table->unsignedInteger('user_id');
            //Role asignado al usuario por el owner de la página
            $table->unsignedInteger('role_id')->default(1);  

            $table->unique(['page_id', 'user_id', 'role_id']);

            $table->foreign('page_id')
                        ->references('id')->on('pages')
                        ->onDelete('cascade');
                        
            $table->foreign('user_id')
                        ->references('id')->on('users')
                        ->onDelete('cascade');

            /*
            $table->foreign('role_id')
                        ->references('id')->on('roles')
                        ->onDelete('cascade');
            */

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
        Schema::dropIfExists('page_user');
    }
}
