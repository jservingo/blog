<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            //El usuario que creó la app (owner)
            $table->unsignedInteger('user_id');
            $table->string('name');

            $table->foreign('parent_id')
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
        Schema::dropIfExists('apps');
    }
}
