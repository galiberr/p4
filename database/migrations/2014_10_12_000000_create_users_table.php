<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
                Schema::create('users', function (Blueprint $table) {
                        $table->increments('id');
                        $table->string('user_name')->unique();
                        $table->string('password', 255);
                        $table->string('email');
                        $table->string('first_name');
                        $table->string('last_name');
                        $table->string('street_addr1');
                        $table->string('street_addr2');
                        $table->string('city');
                        $table->string('state');
                        $table->string('zip');
                        $table->string('about_me');
                        $table->boolean('image');
                        $table->string('credit_card');
                        $table->integer('cc_exp_month')->unsigned();
                        $table->integer('cc_exp_year')->unsigned();
                        $table->string('cc_csv');
                        $table->double('last_lat');
                        $table->double('last_lng');
                        $table->rememberToken();
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
                Schema::drop('users');
        }
}
