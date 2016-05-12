<?php

use Illuminate\Database\Seeder;

class Event_PostsTableSeeder extends Seeder {

        public function run() {
                $eventPosts = [
                    0 => ['Richard Blade Event 1',
                        'roland_galibert',
                        'Looking forward to this!'],
                    1 => ['Richard Blade Event 1',
                        'captain_fantastic',
                        'Me too!'],
                    2 => ['Richard Blade Event 1',
                        'jamal',
                        'Richard Blade Event 1 post from Jamal'],
                    3 => ['JJ Walker Event 1',
                        'captain_fantastic',
                        'JJ Walker Event 1 post from Reg Dwight'],
                    4 => ['JJ Walker Event 1',
                        'bad_girl',
                        'JJ Walker Event 1 post from LaDonna Gaines'],
                    5 => ['JJ Walker Event 1',
                        'roland_galibert',
                        'JJ Walker Event 1 post from Roland Galibert'],
                ];
                for ($i = 0; $i < count($eventPosts); $i++) {
                        $event = \App\Event::where('title', 'like', '%' . $eventPosts[$i][0] . '%')->first();
                        $poster = \App\User::where('user_name', '=', $eventPosts[$i][1])->first();
                        DB::table('event_posts')->insert([
                            'created_at' => Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
                            'event_id' => $event['id'],
                            'poster_id' => $poster['id'],
                            'post' => $eventPosts[$i][2],
                        ]);
                }
        }
}
