<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

        public function run() {
                DB::table('users')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_name' => 'roland_galibert',
                    'password' => Hash::make('helloworld'),
                    'first_name' => 'Roland',
                    'last_name' => 'Galibert',
                    'email' => 'rg@marley32.com',
                    'street_addr1' => '5274 South Road',
                    'street_addr2' => '',
                    'city' => 'Bradford',
                    'state' => 'VT',
                    'zip' => '05033',
                    'about_me' => 'I sing karaoke for fun.',
                    'image' => true,
                    'credit_card' => '0123456789012345',
                    'cc_exp_month' => 1,
                    'cc_exp_year' => 2020,
                    'cc_csv' => '123'
                ]);
                DB::table('users')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_name' => 'richard_blade',
                    'password' => Hash::make('helloworld'),
                    'first_name' => 'Richard',
                    'last_name' => 'Blade',
                    'email' => 'richard@richardblade.com',
                    'street_addr1' => '1 Richard Blade Boulevard',
                    'street_addr2' => 'Apt. 1A',
                    'city' => 'Los Angeles',
                    'state' => 'CA',
                    'zip' => '90004',
                    'about_me' => 'I host karaoke in the LA area.',
                    'image' => true,
                    'credit_card' => '0123456789012345',
                    'cc_exp_month' => 1,
                    'cc_exp_year' => 2020,
                    'cc_csv' => '123'
                ]);
                DB::table('users')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_name' => 'jj_walker',
                    'password' => Hash::make('helloworld'),
                    'first_name' => 'JJ',
                    'last_name' => 'Walker',
                    'email' => 'jj_walker@gmail.com',
                    'street_addr1' => '1 JJ Walker Way',
                    'street_addr2' => '',
                    'city' => 'Los Angeles',
                    'state' => 'CA',
                    'zip' => '90004',
                    'about_me' => 'I host karaoke in the LA area.',
                    'image' => true,
                    'credit_card' => '0123456789012345',
                    'cc_exp_month' => 1,
                    'cc_exp_year' => 2020,
                    'cc_csv' => '123'
                ]);
                DB::table('users')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_name' => 'captain_fantastic',
                    'password' => Hash::make('helloworld'),
                    'first_name' => 'Reg',
                    'last_name' => 'Dwight',
                    'email' => 'reg_dwight@gmail.com',
                    'street_addr1' => '1 Reggie Dwight Boulevard',
                    'street_addr2' => 'Apt. 1A',
                    'city' => 'Los Angeles',
                    'state' => 'CA',
                    'zip' => '90004',
                    'about_me' => 'Love singing karaoke, the bigger the crowd the better.',
                    'image' => true,
                    'credit_card' => '0123456789012345',
                    'cc_exp_month' => 1,
                    'cc_exp_year' => 2020,
                    'cc_csv' => '123'
                ]);
                DB::table('users')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_name' => 'bad_girl',
                    'password' => Hash::make('helloworld'),
                    'first_name' => 'LaDonna',
                    'last_name' => 'Gaines',
                    'email' => 'ladonna_gaines@gmail.com',
                    'street_addr1' => '1 LaDonna Gaines Avenue',
                    'street_addr2' => 'Apt. 2B',
                    'city' => 'Los Angeles',
                    'state' => 'CA',
                    'zip' => '90004',
                    'about_me' => 'Can never sing enough disco.',
                    'image' => true,
                    'credit_card' => '0123456789012345',
                    'cc_exp_month' => 1,
                    'cc_exp_year' => 2020,
                    'cc_csv' => '123'
                ]);
                DB::table('users')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_name' => 'jill',
                    'password' => Hash::make('helloworld'),
                    'first_name' => 'Jill',
                    'last_name' => 'Smith',
                    'email' => 'jill@harvard.edu',
                    'street_addr1' => '10 Massachusetts Avenue',
                    'street_addr2' => 'Apt. 24',
                    'city' => 'Cambridge',
                    'state' => 'MA',
                    'zip' => '02138',
                    'about_me' => 'Student at Harvard.',
                    'image' => false,
                    'credit_card' => '0123456789012345',
                    'cc_exp_month' => 1,
                    'cc_exp_year' => 2020,
                    'cc_csv' => '123'
                ]);
                DB::table('users')->insert([
                    'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                    'user_name' => 'jamal',
                    'password' => Hash::make('helloworld'),
                    'first_name' => 'Jamal',
                    'last_name' => 'Jones',
                    'email' => 'jamal@harvard.edu',
                    'street_addr1' => '103 Memorial Drive',
                    'street_addr2' => 'Suite 33',
                    'city' => 'Cambridge',
                    'state' => 'MA',
                    'zip' => '02138',
                    'about_me' => 'Student at Harvard, moonlight as KJ.',
                    'image' => false,
                    'credit_card' => '0123456789012345',
                    'cc_exp_month' => 1,
                    'cc_exp_year' => 2020,
                    'cc_csv' => '123'
                ]);
        }

}
