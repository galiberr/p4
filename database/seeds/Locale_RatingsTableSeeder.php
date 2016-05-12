<?php

use Illuminate\Database\Seeder;

class Locale_RatingsTableSeeder extends Seeder {
        public function run() {
                $localeRatings = [
                    0 => ['New Yee',
                        'roland_galibert',
                        5,
                        'Great Chinese food! Mai tais too!'],
                    1 => ['Lakeside Inn',
                        'roland_galibert',
                        2,
                        'Surly waitresses!'],
                    2 => ['Joy Asia',
                        'bad_girl',
                        4,
                        'Great Chinese food but tough to get parking.'],
                ];
                for ($i = 0; $i < count($localeRatings); $i++) {
                        $locale = \App\Locale::where('gm_name', 'like', '%' . $localeRatings[$i][0] . '%')->first();
                        $rater = \App\User::where('user_name', '=', $localeRatings[$i][1])->first();
                        DB::table('locale_ratings')->insert([
                            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                            'locale_id' => $locale['id'],
                            'rater_id' => $rater['id'],
                            'rating' => $localeRatings[$i][2],
                            'comment' => $localeRatings[$i][3],
                        ]);
                }
        }

}
