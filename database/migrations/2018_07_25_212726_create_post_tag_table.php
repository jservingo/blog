<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('tag_id');
            //El usuario que le colocó el tag al post
            //Solo se deben mostrar los tags del usuario autenticado
            $table->unsignedInteger('user_id');
            //Cada usuario puede reordenar los sus tags como quiera
            $table->smallInteger('featured')->default(0);
            $table->Integer('position')->default(9999);

            $table->unique(['post_id', 'tag_id', 'user_id']);

            $table->foreign('post_id')
                        ->references('id')->on('posts')
                        ->onDelete('cascade');

            $table->foreign('tag_id')
                        ->references('id')->on('tags')
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
        Schema::dropIfExists('post_tag');
    }
}
