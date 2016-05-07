<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKjRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
                Schema::create('kj_ratings', function (Blueprint $table) {
                        $table->increments('id');
                        $table->integer('kj_id')->unsigned();
                        $table->integer('rater_id')->unsigned();
                        $table->integer('rating')->unsigned();
                        $table->string('comment');
                        $table->timestamps();
                        $table->foreign('kj_id')->references('id')->on('users');
                        $table->foreign('rater_id')->references('id')->on('users');
                });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
                Schema::drop('kj_ratings');
        }
}
