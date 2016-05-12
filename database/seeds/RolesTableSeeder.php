<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

        public function run() {
                DB::table('roles')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'role' => 'admin',
                    'description' => 'KJTracker administrator',
                ]);
                DB::table('roles')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'role' => 'KJ',
                    'description' => 'Karaoke event host',
                ]);
                DB::table('roles')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'role' => 'singer',
                    'description' => 'Basic KTracker user',
                ]);
        }

}
