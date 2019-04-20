<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumText('excerpt')->nullable();
            $table->text('body')->nullable();
            $table->text('iframe')->nullable();
            $table->text('footnote')->nullable();
            $table->timestamp('published_at')->nullable();
            //El usuario que creó el post (owner)
            $table->unsignedInteger('user_id');
            //El tipo de post
            $table->unsignedInteger('type_id')->default(1);
            $table->unsignedInteger('ref_id')->nullable();
            $table->string('url')->nullable();
            //Action button
            $table->smallInteger('action_button_type')->nullable();
            $table->string('action_button_color')->nullable();
            $table->string('action_button_text')->nullable();
            $table->string('action_button_link')->nullable();
            //Offer
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_until')->nullable();            
            //Rating
            $table->smallInteger('rating_mode')->default(1);
            $table->Integer('rating_points')->default(0);
            $table->Integer('rating_num')->default(0);
            $table->Integer('rating')->default(0);
            //Statistics
            $table->Integer('sent_num')->default(0);
            $table->Integer('saved_num')->default(0);                        
            //Constraints
            $table->smallInteger('cstr_privacy')->default(1);
            $table->smallInteger('cstr_restricted')->default(1);
            //Si un post es colaborativo otros usuarios pueden
            //agregar fotos al post photo-gallery 
            $table->smallInteger('cstr_colaborative')->default(1);
            $table->smallInteger('cstr_send_massive')->default(0);
            $table->smallInteger('cstr_allow_comments')->default(1);

            $table->foreign('user_id')
                        ->references('id')->on('users')
                        ->onDelete('cascade');

            $table->foreign('type_id')
                        ->references('id')->on('types')
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
        Schema::dropIfExists('posts');
    }
}
