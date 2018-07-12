<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update180712UserLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_link', function (Blueprint $table) {
            $table->integer('userId')->unsigned()->index()->change();
            $table->integer('linkId')->unsigned()->index()->change();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('linkId')->references('id')->on('links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_link', function (Blueprint $table) {
            $table->dropForeign(['userId']);
            $table->dropForeign(['linkId']);
        });
    }
}
