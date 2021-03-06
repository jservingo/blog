<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('name');
            //La página a la cual pertenece la categoría
            $table->unsignedInteger('page_id');

            //$table->unique(['page_id', 'name']);

            $table->foreign('parent_id')
                        ->references('id')->on('categories')
                        ->onDelete('cascade');

            $table->foreign('page_id')
                        ->references('id')->on('pages')
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
        Schema::dropIfExists('categories');
    }
}
