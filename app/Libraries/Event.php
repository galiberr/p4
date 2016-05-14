<?php
/*
 * Author:      Roland Galibert
 * Date:        May 13, 2016
 * For:         CSCI E-15 Dynamic Web Applications, Spring 2016 - Project 4
 * Purpose:     Various functionality supporting event CRUD for KaraokeTracker web application
 */

namespace App\Libraries;
use League\Geotools\Coordinate\Ellipsoid;
use Toin0u\Geotools\Facade\Geotools;
use Intervention\Image\ImageManager;

class Event {
        
        /*
         * Function: getEvent()
         * Purpose: Returns the event record with the given ID.
         */
        public static function getEvent($event_id) {
                $event = \App\Event::where('id', '=', $event_id)->with('kj')->with('locale')->with('posts')->first();
                return $event;
        }

        /*
         * Function: getEventsForKJID()
         * Purpose: Returns all events associated with the given KJ (user) ID,
         * along with associated kj, locale and event post records.
         */
        public static function getEventsForKJID($kj_id) {
                $events = \App\Event::where('kj_id', '=', $kj_id)->with('kj')->with('locale')->with('posts')->get();
                return $events;
        }

        /*
         * Function: createEvent()
         * Purpose: Executes actual DB creation of an event, based on the
         * request data and locale.
         */
        public static function createEvent($request, $locale) {
                $event = new \App\Event();
                $event->title = $request->title;
                $event->description = $request->description;
                $event->kj_id = \Auth::user()->id;
                $event->locale_id = $locale->id;
                $event->recurring = ($request->eventType == 0);
                $event->day_of_week = $request->day_of_week;
                $event->next_date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->next_date);
                $start_time = intval($request->start_time) + (intval($request->start_time_AMPM) * 1200);
                $event->start_time = \Carbon\Carbon::createFromTime((int) ($start_time / 100), ($start_time % 100), 0);
                $end_time = intval($request->end_time) + (intval($request->end_time_AMPM) * 1200);
                $event->end_time = \Carbon\Carbon::createFromTime((int) ($end_time / 100), ($end_time % 100), 0);
                $event->image = $request->hasFile('image') && $request->file('image')->isValid();
                $event->save();
                
                /*
                 * Store any image the user uploaded, as the original as well as display
                 * and thumbnail.
                 */
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                        $request->file('image')->move(base_path() . '/public/assets/uploads/events' . $event->id . '/', 'original');
                        \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events' . $event->id . '/original',
                                base_path() . '/public/assets/uploads/events' . $event->id . '/display_image');
                        \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events' . $event->id . '/original',
                                base_path() . '/public/assets/uploads/events' . $event->id . '/thumbnail');
                }
        }

        /*
         * Function: updateEvent()
         * Purpose: Executes actual DB update of an event, based on the
         * request data and locale.
         */
        public static function updateEvent($request, $locale) {
                $event = \App\Libraries\Event::getEvent($request->event_id);
                $event->title = $request->title;
                $event->description = $request->description;
                $event->kj_id = \Auth::user()->id;
                $event->locale_id = $locale->id;
                $event->recurring = ($request->eventType == 0);
                $event->day_of_week = $request->day_of_week;
                $event->next_date = \Carbon\Carbon::createFromFormat('m/d/Y', $request->next_date);
                $start_time = intval($request->start_time) + (intval($request->start_time_AMPM) * 1200);
                $event->start_time = \Carbon\Carbon::createFromTime((int) ($start_time / 100), ($start_time % 100), 0);
                $end_time = intval($request->end_time) + (intval($request->end_time_AMPM) * 1200);
                $event->end_time = \Carbon\Carbon::createFromTime((int) ($end_time / 100), ($end_time % 100), 0);
                $event->image = $request->hasFile('image') && $request->file('image')->isValid();
                $event->save();
                
                /*
                 * Store any image the user uploaded, as the original as well as display
                 * and thumbnail.
                 */
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                        $request->file('image')->move(base_path() . '/public/assets/uploads/events' . $event->id . '/', 'original');
                        \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events' . $event->id . '/original',
                                base_path() . '/public/assets/uploads/events' . $event->id . '/display_image');
                        \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events' . $event->id . '/original',
                                base_path() . '/public/assets/uploads/events' . $event->id . '/thumbnail');
                }
                return $event;
        }

        /*
         * Function: filterByLocation()
         * Purpose: Takes the events which have been passed in and returns an
         * array of those which occur within the specified radius of the coordinate
         * at the speicifed latitude and longitude.
         */
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
        
        /*
         * Function: nextDate()
         * Purpose: Returns the actual date on which the given day of the week
         * will next occur.
         */
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
        
        /*
         * Function: dayOfWeek()
         * Purpose: Returns the string form of the input day of the week.
         */
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
        
        /*
         * Function: generateDisplayImage()
         * Purpose: Generates a display image of the image specified by
         * $sourceFile and saves this to $targetFile.
         */
        public static function generateDisplayImage($sourceFile, $targetFile) {
                $height = 150;
                $width = 150;
                $manager = new ImageManager();
                $img = $manager->make($sourceFile);
                $img->fit($height, $width);
                $img->save($targetFile);
                return;
        }
        
        /*
         * Function: generateThumbnail()
         * Purpose: Generates a thumbnail of the image specified by
         * $sourceFile and saves this to $targetFile.
         */
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
