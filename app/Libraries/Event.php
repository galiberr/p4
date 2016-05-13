<?php

namespace App\Libraries;
use League\Geotools\Coordinate\Ellipsoid;
use Toin0u\Geotools\Facade\Geotools;
use Intervention\Image\ImageManager;

class Event {
        public static function getEvent($event_id) {
                $event = \App\Event::where('id', '=', $event_id)->with('kj')->with('locale')->with('posts')->first();
                return $event;
        }

        public static function getEventsForKJID($kj_id) {
                $events = \App\Event::where('kj_id', '=', $kj_id)->with('kj')->with('locale')->with('posts')->get();
                return $events;
        }

        public static function createEvent($request, $locale) {
                $event = new \App\Event();
                $event->title = $request->title;
                $event->description = $request->description;
                $event->kj_id = \Auth::user()->id;
                $event->locale_id = $locale->id;
                $event->recurring = ($request->eventType == 0);
                $event->day_of_week = $request->day_of_week;
                $event->next_date = $request->next_date;
                $event->start_time = $request->start_time + ($request->start_timeAMPM * 12);
                $event->end_time = $request->end_time + ($request->end_timeAMPM * 12);
                $event->end_time = $request->hasFile('image') && $request->file('image')->isValid();
                $event->save();
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                        $request->file('image')->move(base_path() . '/public/assets/uploads/events' . $event->id . '/', 'original');
                        \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events' . $event->id . '/original',
                                base_path() . '/public/assets/uploads/events' . $event->id . '/display_image');
                        \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events' . $event->id . '/original',
                                base_path() . '/public/assets/uploads/events' . $event->id . '/thumbnail');
                }
        }

        public static function updateEvent($request, $locale) {
                $event = \App\Libraries\Event::getEvent($request->event_id);
                $event->title = $request->title;
                $event->description = $request->description;
                $event->kj_id = \Auth::user()->id;
                $event->locale_id = $locale->id;
                $event->recurring = ($request->eventType == 0);
                $event->day_of_week = $request->day_of_week;
                $event->next_date = $request->next_date;
                $event->start_time = $request->start_time + ($request->start_timeAMPM * 12);
                $event->end_time = $request->end_time + ($request->end_timeAMPM * 12);
                $event->end_time = $request->hasFile('image') && $request->file('image')->isValid();
                $event->save();
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                        $request->file('image')->move(base_path() . '/public/assets/uploads/events' . $event->id . '/', 'original');
                        \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events' . $event->id . '/original',
                                base_path() . '/public/assets/uploads/events' . $event->id . '/display_image');
                        \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events' . $event->id . '/original',
                                base_path() . '/public/assets/uploads/events' . $event->id . '/thumbnail');
                }
                return $event;
        }

        public static function filterByLocation($events, $lat, $lng, $radius) {
                $filteredEvents = [];
                $totalEventCount = count($events);
                for ($i = 0; $i < $totalEventCount; $i++) {
                        $coordA = Geotools::coordinate([$events[$i]->locale->gm_lat, $events[$i]->locale->gm_lng]);
                        $coordB = Geotools::coordinate([$lat, $lng]);
                        $distance = Geotools::distance()->setFrom($coordA)->setTo($coordB);
                        if ($distance->in('mi')->flat() <= $radius) {
                                $filteredEvents[] = $events[$i];
                        }
                }
                return $filteredEvents;
        }
        
        public static function nextDate($dayOfWeek) {
                if (\Carbon\Carbon::now()->dayOfWeek == $dayOfWeek) {
                        return \Carbon\Carbon::now();
                } else {
                        switch ($dayOfWeek) {
                                case 0:
                                        return new \Carbon\Carbon('next sunday');
                                case 1:
                                        return new \Carbon\Carbon('next monday');
                                case 2:
                                        return new \Carbon\Carbon('next tuesday');
                                case 3:
                                        return new \Carbon\Carbon('next wednesday');
                                case 4:
                                        return new \Carbon\Carbon('next thursday');
                                case 5:
                                        return new \Carbon\Carbon('next friday');
                                case 6:
                                        return new \Carbon\Carbon('next saturday');
                        }
                }
        }
        
        public static function dayOfWeek($dayOfWeek) {
                switch ($dayOfWeek) {
                        case 0:
                                return 'Sunday';
                        case 1:
                                return 'Monday';
                        case 2:
                                return 'Tuesday';
                        case 3:
                                return 'Wednesday';
                        case 4:
                                return 'Thursday';
                        case 5:
                                return 'Friday';
                        case 6:
                                return 'Saturday';
                }
        }
        public static function generateDisplayImage($sourceFile, $targetFile) {
                $height = 150;
                $width = 150;
                $manager = new ImageManager();
                $img = $manager->make($sourceFile);
                $img->fit($height, $width);
                $img->save($targetFile);
                return;
        }
        
        public static function generateThumbnail($sourceFile, $targetFile) {
                $height = 30;
                $width = 30;
                $manager = new ImageManager();
                $img = $manager->make($sourceFile);
                $img->fit($height, $width);
                $img->save($targetFile);
                return;
        }
        
}
