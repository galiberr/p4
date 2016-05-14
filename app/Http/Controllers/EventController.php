<?php
/*
 * Author:      Roland Galibert
 * Date:        May 13, 2016
 * For:         CSCI E-15 Dynamic Web Applications, Spring 2016 - Project 4
 * Purpose:     Controller for event CRUD views for KaraokeTracker web application
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller {

        /*
         * Input validation rules
         */
        private static $rules = [
            'title' => 'required',
            'description' => 'required',
            'day_of_week' => 'required_if:eventType,0',
            'next_date' => 'required_if:eventType,1',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
        
        /*
         * Input validation error messages
         */
        private static $messages = [
            'title.required' => 'Event must have a title.',
            'description.required' => 'Event must have a description.',
            'day_of_week.required_if' => 'Day of week must be selected for recurring event.',
            'next_date.required_if' => 'Date must be selected for one-time event.',
            'start_time.required' => 'Event must have a start time.',
            'end_time.required' => 'Event must have a start time.',
        ];

        /*
         * Function: getCreate()
         * Purpose: Calls view for creating a karaoke event
         */
        public function getCreate() {
                return view('events/create');
        }
        
        /*
         * Function: postCreate()
         * Purpose: Processes event creation form input
         */
        public function postCreate(Request $request) {
                $this->validate($request, self::$rules, self::$messages);
                
                /*
                 * Find out if Google Maps locale selected by user has already
                 * been saved to the database; if not, create it with
                 * Google Maps fields
                 */
                $locale = \App\Libraries\Locale::getLocale($request->gm_place_id);
                if (is_null($locale)) {
                        $locale= \App\Libraries\Locale::createLocale($request->gm_place_id,
                                                                        $request->gm_name,
                                                                        $request->gm_formatted_address,
                                                                        $request->gm_lat,
                                                                        $request->gm_lng);
                }
                
                /*
                 * Create event
                 */
                \App\Libraries\Event::createEvent($request, $locale);
                return view('events/create');
        }

        /*
         * Function: getSearch()
         * Purpose: Calls view to search for a karaoke event
         */
        public function getSearch() {
                return view('events/search');
        }
        
        /*
         * Function: postSearch()
         * Purpose: Processes event search form input
         */
        public function postSearch(Request $request) {
                
                /*
                 * Get all events associated with logged in (KJ) user and
                 * filter by radius and Google Maps data passed in
                 */
                $all_events = \App\Event::with('kj')->with('locale')->get();
                $filtered_events = \App\Libraries\Event::filterByLocation($all_events,
                        floatval($request->gm_lat),
                        floatval($request->gm_lng),
                        floatval($request->radius));

                /*
                 * Return results through AJAX
                 */
                return view('events/search-ajax', ['events' => $filtered_events]);
        }

        /*
         * Function: getEdit()
         * Purpose: Calls view to edit a karaoke event
         */
        public function getEdit($id) {
                
                /*
                 * Find the event associated with the ID and output errors if
                 * no such event exists or if the event doesn't belong to the
                 * logged in user.
                 */
                $event = \App\Libraries\Event::getEvent($id);
                if (is_null($event)) {
                        \Session::flash('flash_message', 'No such event exists.');
                        return redirect ("/");
                }
                if ($event->kj->id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to edit this event.');
                        return redirect ("/");
                }

                /*
                 * Display event in the edit form.
                 */
                return view('events/edit', ['event' => $event]);
        }
        
        /*
         * Function: postEdit()
         * Purpose: Processes event edit form input
         */
        public function postEdit(Request $request) {
                $this->validate($request, self::$rules, self::$messages);
                
                /*
                 * In case a new locale has been entered for the event, execute
                 * code to find it and save it if necessary.
                 */
                $locale = \App\Libraries\Locale::getLocale($request->gm_place_id);
                if (is_null($locale)) {
                        $locale= \App\Libraries\Locale::createLocale($request->gm_place_id,
                                                                        $request->gm_name,
                                                                        $request->gm_formatted_address,
                                                                        $request->gm_lat,
                                                                        $request->gm_lng);
                }
                $event = \App\Libraries\Event::updateEvent($request, $locale);
                \Session::flash('flash_message', 'Your event information has been updated.');
                return view('events/edit', ['event' => $event]);
        }

        /*
         * Function: getShowMyEvents()
         * Purpose: Calls view to display to the user the karaoke events he/she
         * created. The user must be a KJ type user.
         */
        public function getShowMyEvents() {
                if (strcmp(\Auth::user()->roles()->first()->role, 'KJ') != 0) {
                        \Session::flash('flash_message', 'You are not authorized to that page.');
                        return redirect('/');
                }
                $events = \App\Libraries\Event::getEventsForKJID(\Auth::user()->id);
                return view('events/myEvents', ['events' => $events]);
        }

        /*
         * Function: getDetail()
         * Purpose: Calls view to display the detail for the karaoke event with
         * the specified ID.
         */
        public function getDetail($id) {
                $event = \App\Libraries\Event::getEvent($id);
                if (is_null($event)) {
                        \Session::flash('flash_message', 'No such event exists.');
                }
                return view('events/detail', ['event' => $event]);
        }

        /*
         * Function: postDetail()
         * Purpose: Saves a user post entered to an event detail page then
         * calls the AJAX view to immediately display in to the page.
         */
        public function postDetail(Request $request) {
                $event = [];
                if (strlen($request->event_post) > 0) {
                        $new_post = new \App\Event_post();
                        $new_post->event_id = $request->event_id;
                        $new_post->poster_id = \Auth::user()->id;
                        $new_post->post = $request->event_post;
                        $new_post->save();
                        $event = \App\Libraries\Event::getEvent($request->event_id);
                }
                return view('events/detail-ajax', ['event' => $event]);
        }

        /*
         * Function: getConfirmDelete()
         * Purpose: Performs initial processing for an event deletion request
         * submitted by a user.
         */
        public function getConfirmDelete($id) {
                
                /*
                 * Retrieve the event and output error messages if it does not
                 * exist or if the logged in user is not authorized to delete it.
                 */
                $event = \App\Libraries\Event::getEvent($id);
                if (is_null($event)) {
                        \Session::flash('flash_message', 'No such event exists.');
                        return redirect ("/");
                }
                if ($event->kj->id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to delete this event.');
                        return redirect ("/");
                }
                
                /*
                 * Call the delete confirmation view.
                 */
                return view('events/delete-confirm', ['event' => $event]);
        }
        
        /*
         * Function: getDelete()
         * Purpose: Performs actual deletion for an event deletion request
         * submitted by a user.
         */
        public function getDelete($id) {
                
                /*
                 * Retrieve the event and output error messages if it does not
                 * exist or if the logged in user is not authorized to delete it.
                 */
                $event = \App\Libraries\Event::getEvent($id);
                if (is_null($event)) {
                        \Session::flash('flash_message', 'No such event exists.');
                        return redirect ("/");
                }
                if ($event->kj->id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to delete this event.');
                        return redirect ("/");
                }
                
                $event->delete();
                \Session::flash('flash_message', 'Your event has been deleted.');
                return redirect("/");
        }
}