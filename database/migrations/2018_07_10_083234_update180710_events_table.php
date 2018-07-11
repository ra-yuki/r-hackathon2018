<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update180710EventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            // news
            $table->dateTime('dateTimeFromSelf')->nullable();
            $table->dateTime('dateTimeToSelf')->nullable();
            $table->string('eventPath');
            // changes
            $table->date('dateFrom')->nullable()->change();
            $table->date('dateTo')->nullable()->change();
            $table->time('timeFrom')->nullable()->change();
            $table->time('timeTo')->nullable()->change();
            $table->string("location")->nullable()->change();
            $table->text("description")->nullable()->change();
            $table->integer('linkId')->nullable()->change();
            $table->dropColumn("groupId");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            // news
            $table->dropColumn('dateTimeFromSelf');
            $table->dropColumn('dateTimeToSelf');
            $table->dropColumn('eventPath');
            // changes
            $table->date('dateFrom')->nullable(false)->change();
            $table->date('dateTo')->nullable(false)->change();
            $table->time('timeFrom')->nullable(false)->change();
            $table->time('timeTo')->nullable(false)->change();
            $table->string("location")->nullable(false)->change();
            $table->text("description")->nullable(false)->change();
            $table->integer('linkId')->nullable(false)->change();
            $table->integer("groupId");
        });
    }
}
