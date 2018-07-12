<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update180712UserFriendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_friend', function (Blueprint $table) {
            $table->integer('userId')->unsigned()->index()->change();
            $table->integer('friendId')->unsigned()->index()->change();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('friendId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_friend', function (Blueprint $table) {
            $table->dropForeign(['userId']);
            $table->dropForeign(['friendId']);
        });
    }
}
