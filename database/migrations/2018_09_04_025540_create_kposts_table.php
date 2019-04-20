<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kposts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            //El usuario al cual le fue enviado el post
            $table->unsignedInteger('user_id');
            //El usuario que envía el post
            $table->unsignedInteger('sent_by');
            //La fecha en la cual fue enviado el post            
            $table->timestamp('sent_at')->nullable();
            //El status del post
            $table->smallInteger('status_id')->default(0);
            //User data
            $table->text('observation')->nullable();
            $table->text('footnote')->nullable();
            $table->timestamp('updatet_at')->nullable();
            $table->Integer('rating_points')->default(0);
            //Se utiliza para mostrar de primero el post 
            //dentro de todos los catalogos
            $table->smallInteger('featured')->default(0);
            //Mark
            $table->smallInteger('mark_type')->nullable();
            $table->string('mark_color')->nullable();
            $table->string('mark_text')->nullable();
            $table->string('mark_link')->nullable();

            $table->unique(['post_id', 'user_id']);

            $table->foreign('post_id')
                        ->references('id')->on('posts')
                        ->onDelete('cascade');
                        
            $table->foreign('user_id')
                        ->references('id')->on('users')
                        ->onDelete('cascade');

            $table->foreign('sent_by')
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
        Schema::dropIfExists('kposts');
    }
}
