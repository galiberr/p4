<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder {
        public function run() {
                $events = [
                    0 => ['Richard Blade Event 1',
                        'Richard Blade\'s 1st event',
                        'richard_blade',
                        'New Yee',
                        false,  # recurring
                        6,      # day of week
                        Carbon\Carbon::createFromDate(2016, 6, 3),     # next date Carbon\Carbon::createFromDate()
                        Carbon\Carbon::createFromTime(20, 0, 0),     # start time
                        Carbon\Carbon::createFromTime(0, 0, 0),     # end time
                        false,],    # image
                    1 => ['Richard Blade Event 2',
                        'Richard Blade\'s 2nd event',
                        'richard_blade',
                        'Joy Asia',
                        true,  # recurring
                        6,      # day of week
                        Carbon\Carbon::createFromDate(2016, 6, 3),     # next date Carbon\Carbon::createFromDate()
                        Carbon\Carbon::createFromTime(21, 0, 0),     # start time
                        Carbon\Carbon::createFromTime(1, 0, 0),     # end time
                        false,],    # image
                    2 => ['JJ Walker Event 1',
                        'JJ Walker\'s 2nd event',
                        'jj_walker',
                        'Joy Asia',
                        true,  # recurring
                        6,      # day of week
                        Carbon\Carbon::createFromDate(2016, 6, 3),     # next date Carbon\Carbon::createFromDate()
                        Carbon\Carbon::createFromTime(18, 0, 0),     # start time
                        Carbon\Carbon::createFromTime(21, 0, 0),     # end time
                        false,],    # image
                    3 => ['JJ Walker Event 2',
                        'JJ Walker\'s 2nd event',
                        'jj_walker',
                        'Lakeside Inn',
                        false,  # recurring
                        5,      # day of week
                        Carbon\Carbon::createFromDate(2016, 6, 10),     # next date Carbon\Carbon::createFromDate()
                        Carbon\Carbon::createFromTime(20, 0, 0),     # start time
                        Carbon\Carbon::createFromTime(22, 0, 0),     # end time
                        false,],    # image
                    4 => ['Richard Blade Event 3',
                        'Richard Blade\'s 3rd event',
                        'richard_blade',
                        'Spare Time',
                        false,  # recurring
                        7,      # day of week
                        Carbon\Carbon::createFromDate(2016, 7, 30),     # next date Carbon\Carbon::createFromDate()
                        Carbon\Carbon::createFromTime(20, 0, 0),     # start time
                        Carbon\Carbon::createFromTime(0, 0, 0),     # end time
                        false,],    # image
                    5 => ['Richard Blade Event 4',
                        'Richard Blade\'s 4th event',
                        'richard_blade',
                        'Salt Hill',
                        true,  # recurring
                        5,      # day of week
                        Carbon\Carbon::createFromDate(2016, 7, 30),     # next date Carbon\Carbon::createFromDate()
                        Carbon\Carbon::createFromTime(20, 0, 0),     # start time
                        Carbon\Carbon::createFromTime(0, 0, 0),     # end time
                        false,],    # image
                ];
                
                for ($i = 0; $i < count($events); $i++) {
                        $kj = \App\User::where('user_name', '=', $events[$i][2])->first();
                        $locale = \App\Locale::where('gm_name', 'like', '%'.$events[$i][3].'%')->first();
                        DB::table('events')->insert([
                                'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                                'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                                'title' => $events[$i][0],
                                'description' => $events[$i][1],
                                'kj_id' => $kj['id'],
                                'locale_id' => $locale['id'],
                                'recurring' => $events[$i][4],
                                'day_of_week' => $events[$i][5],
                                'next_date' => $events[$i][6],
                                'start_time' => $events[$i][7],
                                'end_time' => $events[$i][8],
                                'image' => $events[$i][9]
                        ]);
                }
        }

}
