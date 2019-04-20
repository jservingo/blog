<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_post', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('catalog_id');
            $table->unsignedInteger('post_id');
            //Si el catálogo es colaborativo otro usuario puede
            //agregar un post al catálogo
            $table->unsignedInteger('user_id');
            //Solamente el owner del catálogo puede usar featured y position
            $table->smallInteger('featured')->default(0);
            $table->Integer('position')->default(9999);

            $table->unique(['catalog_id', 'post_id']);

            $table->foreign('post_id')
                        ->references('id')->on('posts')
                        ->onDelete('cascade');
                        
            $table->foreign('catalog_id')
                        ->references('id')->on('catalogs')
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
        Schema::dropIfExists('catalog_post');
    }
}
