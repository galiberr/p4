<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
        public function up()
        {
                Schema::create('events', function (Blueprint $table) {
                        $table->increments('id');
                        $table->string('title');
                        $table->string('description');
                        $table->integer('kj_id')->unsigned();
                        $table->integer('locale_id')->unsigned();
                        $table->boolean('recurring');
                        $table->integer('day_of_week')->unsigned();
                        $table->date('next_date');
                        $table->time('start_time');
                        $table->time('end_time');
                        $table->boolean('image');
                        $table->timestamps();
                        $table->foreign('kj_id')->references('id')->on('users');
                        $table->foreign('locale_id')->references('id')->on('locales');
                });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
                Schema::drop('events');
        }
}
