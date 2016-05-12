<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

        public function run() {
                $this->call(UsersTableSeeder::class);
                $this->call(RolesTableSeeder::class);
                $this->call(RoleUserTableSeeder::class);
                $this->call(KJ_RatingsTableSeeder::class);
                $this->call(LocalesTableSeeder::class);
                $this->call(EventsTableSeeder::class);
                $this->call(Event_PostsTableSeeder::class);
                $this->call(Locale_RatingsTableSeeder::class);
        }

}
