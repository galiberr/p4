<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
                Schema::create('locales', function (Blueprint $table) {
                        $table->increments('id');
                        $table->string('location_link');
                        $table->string('name');
                        $table->string('address');
                        $table->string('image');
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
                Schema::drop('locales');
        }
}
