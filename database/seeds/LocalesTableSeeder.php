<?php

use Illuminate\Database\Seeder;

class LocalesTableSeeder extends Seeder {
        public function run() {
                DB::table('locales')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'gm_place_id' => 'ChIJj2TG-pJO4okRyi7XnDs1VNk',
                    'gm_name' => 'New Yee Dynasty Banquet',
                    'gm_formatted_address' => '830 S Willow St, Manchester, NH 03103, United States',
                    'gm_lat' => 42.9641442,
                    'gm_lng' => -71.4439976,
                ]);
                DB::table('locales')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'gm_place_id' => 'ChIJ0YK1qIqL44kRPpJ0ydbs9As',
                    'gm_name' => 'Joy Asia Restaurant',
                    'gm_formatted_address' => '735 Boston Post Rd E, Marlborough, MA 01752, United States',
                    'gm_lat' => 42.350193,
                    'gm_lng' => -71.500591,
                ]);
                DB::table('locales')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'gm_place_id' => 'ChIJlZmq0bEM44kRGFCikJDDXhQ',
                    'gm_name' => 'The Lakeside Inn',
                    'gm_formatted_address' => '595 North Ave, Wakefield, MA 01880, United States',
                    'gm_lat' => 42.515367,
                    'gm_lng' => -71.0848729,
                ]);
                DB::table('locales')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'gm_place_id' => 'ChIJAYwLZedO4okRrQHdPVtrBb4',
                    'gm_name' => 'Spare Time',
                    'gm_formatted_address' => '216 Maple St, Manchester, NH 03103, United States',
                    'gm_lat' => 42.9806343,
                    'gm_lng' => -71.4533774,
                ]);
                DB::table('locales')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'gm_place_id' => 'ChIJK6Mjt-fJtEwRi-jpfeo3Yww',
                    'gm_name' => 'Salt Hill Pub',
                    'gm_formatted_address' => '7 Lebanon St #103, Hanover, NH 03755, United States',
                    'gm_lat' => 43.7005108,
                    'gm_lng' => -72.2884556,
                ]);
        }
}
