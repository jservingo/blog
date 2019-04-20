<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('app_id');
            $table->unsignedInteger('user_id');
            //Status asignado al usuario por el owner de la app
            $table->unsignedInteger('status_id')->default(1);  

            $table->unique(['app_id', 'user_id']);

            $table->foreign('app_id')
                        ->references('id')->on('apps')
                        ->onDelete('cascade');
                        
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
        Schema::dropIfExists('app_user');
    }
}
