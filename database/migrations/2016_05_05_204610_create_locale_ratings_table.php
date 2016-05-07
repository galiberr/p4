<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocaleRatingsTable extends Migration
{
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
                Schema::create('locale_ratings', function (Blueprint $table) {
                        $table->increments('id');
                        $table->integer('locale_id')->unsigned();
                        $table->integer('rater_id')->unsigned();
                        $table->integer('rating')->unsigned();
                        $table->string('comment');
                        $table->timestamps();
                        $table->foreign('locale_id')->references('id')->on('locales');
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
                Schema::drop('locale_ratings');
        }
}
