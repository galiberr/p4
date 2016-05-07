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
                        $table->string('name');
                        $table->string('email')->unique();
                        $table->string('password');
                        $table->string('user_id');
                        $table->string('email');
                        $table->string('street_addr1');
                        $table->string('street_addr2');
                        $table->string('city');
                        $table->string('state');
                        $table->string('zip');
                        $table->string('image');
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
