<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_category', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('catalog_id');
            $table->unsignedInteger('category_id');
            //Si la pagina es colaborativa un usuario subscrito
            //puede agregar un catálogo a la categoría  
            $table->unsignedInteger('user_id'); 
            //Solamente el owner de la página puede usar featured y position
            $table->smallInteger('featured')->default(0);
            $table->Integer('position')->default(9999);

            $table->unique(['catalog_id', 'category_id']);

            $table->foreign('catalog_id')
                        ->references('id')->on('catalogs')
                        ->onDelete('cascade');
                        
            $table->foreign('category_id')
                        ->references('id')->on('categories')
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
        Schema::dropIfExists('catalog_category');
    }
}
