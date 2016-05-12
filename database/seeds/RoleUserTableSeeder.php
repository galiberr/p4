<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder {

        public function run() {
                $users = [
                    0 => ['roland_galibert', ['admin', 'singer']],
                    1 => ['richard_blade', ['KJ']],
                    2 => ['jj_walker', ['KJ']],
                    3 => ['captain_fantastic', ['singer']],
                    4 => ['bad_girl', ['singer']],
                    5 => ['jill', ['singer']],
                    6 => ['jamal', ['KJ']],
                ];

                # Now loop through the above array, creating a new pivot for each book to tag
                for ($i = 0; $i < count($users); $i++) {
                        $user = \App\User::where('user_name', 'like', $users[$i][0])->first();
                        for ($j = 0; $j < count($users[$i][1]); $j++) {
                                $role_record = \App\Role::where('role', 'like', $users[$i][1][$j])->first();
                                $user->roles()->save($role_record);
                        }
                }
        }

}
