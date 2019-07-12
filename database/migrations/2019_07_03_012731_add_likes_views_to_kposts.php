<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLikesViewsToKposts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kposts',  function (Blueprint $table) {
            $table->unsignedInteger('likes')->default(0)->after('footnote');
            $table->unsignedInteger('views')->default(0)->after('likes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kposts', function (Blueprint $table) {
            $table->dropColumn('likes');
            $table->dropColumn('views');
        });
    }
}
