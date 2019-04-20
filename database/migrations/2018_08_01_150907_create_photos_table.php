<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            //Si el post es colaborativo se debe guardar el id
            //del usuario que agregó la foto al post
            $table->unsignedInteger('user_id');
            $table->string('url')->nullable();
            $table->text('iframe')->nullable();
            $table->text('description')->nullable();
            //Solamente el owner del post puede usar featured y position
            $table->smallInteger('featured')->default(0);
            $table->Integer('position')->default(9999);
            //Rating
            $table->smallInteger('rating_mode')->default(1);
            $table->Integer('rating_points')->default(0);
            $table->Integer('rating_num')->default(0);
            $table->Integer('rating')->default(0);
            
            $table->foreign('post_id')
                        ->references('id')->on('posts')
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
        Schema::dropIfExists('photos');
    }
}
