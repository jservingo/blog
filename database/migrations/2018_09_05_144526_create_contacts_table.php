<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            
            //El usuario al que le pertenece el contacto
            $table->unsignedInteger('user_id');
            //El contacto mismo
            $table->unsignedInteger('user_ref');
            //Aquí van los datos del contacto
            $table->string('contact')->nullable();
            $table->mediumText('address')->nullable();
            $table->text('comment')->nullable();
            $table->smallInteger('status')->nullable();

            $table->unique(['user_id', 'user_ref']);

            $table->foreign('user_id')
                        ->references('id')->on('users')
                        ->onDelete('cascade');
                        
            $table->foreign('user_ref')
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
        Schema::dropIfExists('contacts');
    }
}
