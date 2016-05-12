<?php

use Illuminate\Database\Seeder;

class KJ_RatingsTableSeeder extends Seeder {

        public function run() {
                $ratings = [
                    0 => ['richard_blade', 'roland_galibert', 5, 'Richard is great, I\'m giving him a 5! - Roland'],
                    1 => ['richard_blade', 'captain_fantastic', 4, 'Richard is good, I\'m giving him a 4! - Reg'],
                    2 => ['richard_blade', 'bad_girl', 5, 'Richard is great, I\'m giving him a 5! - LaDonna'],
                    3 => ['richard_blade', 'jill', 5, 'Richard is average, I\'m giving him a 3! - Jill'],
                    4 => ['jj_walker', 'roland_galibert', 5, 'JJ is great, I\'m giving him a 5! - Roland'],
                    5 => ['jj_walker', 'captain_fantastic', 4, 'JJ is terrible! I\'m giving him a 1! - Reg'],
                    6 => ['jj_walker', 'bad_girl', 5, 'JJ lacks direction! I\'m giving him a 2! - LaDonna']
                ];
                
                for ($i = 0; $i < count($ratings); $i++) {
                        $kj = \App\User::where('user_name', '=', $ratings[$i][0])->first();
                        $rater = \App\User::where('user_name', '=', $ratings[$i][1])->first();
                        DB::table('kj_ratings')->insert([
                            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                            'kj_id' => $kj['id'],
                            'rater_id' => $rater['id'],
                            'rating' => $ratings[$i][2],
                            'comment' => $ratings[$i][3],
                        ]);
                }
        }

}
