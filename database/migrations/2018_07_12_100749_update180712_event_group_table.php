<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update180712EventGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_group', function (Blueprint $table) {
            $table->integer('eventId')->unsigned()->index()->change();
            $table->integer('groupId')->unsigned()->index()->change();
            $table->foreign('eventId')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('groupId')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_group', function (Blueprint $table) {
            $table->dropForeign(['eventId']);
            $table->dropForeign(['groupId']);
        });
    }
}
