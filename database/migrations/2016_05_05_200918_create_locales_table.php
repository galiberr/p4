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
                        $table->string('gm_place_id');
                        $table->string('gm_name');
                        $table->string('gm_formatted_address');
                        $table->double('gm_lat');
                        $table->double('gm_lng');
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
