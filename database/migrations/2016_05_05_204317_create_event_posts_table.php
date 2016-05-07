<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPostsTable extends Migration
{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
                Schema::create('event_posts', function (Blueprint $table) {
                        $table->increments('id');
                        $table->integer('event_id')->unsigned();
                        $table->integer('poster_id')->unsigned();
                        $table->string('post');
                        $table->timestamps();
                        $table->foreign('event_id')->references('id')->on('events');
                        $table->foreign('poster_id')->references('id')->on('users');
                });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
                Schema::drop('event_posts');
        }
}
