<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller {
        private static $rules = [
            'title' => 'required',
            'description' => 'required',
            'day_of_week' => 'required_if:eventType,0',
            'next_date' => 'required_if:eventType,1',
            'start_time' => 'required',
            'end_time' => 'required',
        ];
        private static $messages = [
            'title.required' => 'Event must have a title.',
            'description.required' => 'Event must have a description.',
            'day_of_week.required_if' => 'Day of week must be selected for recurring event.',
            'next_date.required_if' => 'Date must be selected for one-time event.',
            'start_time.required' => 'Event must have a start time.',
            'end_time.required' => 'Event must have a start time.',
        ];

        public function getCreate() {
                return view('events/create');
        }
        
        public function postCreate(Request $request) {
                $this->validate($request, self::$rules, self::$messages);
                $locale = \App\Libraries\Locale::getLocale($request->gm_place_id);
                if (is_null($locale)) {
                        $locale= \App\Libraries\Locale::createLocale($request->gm_place_id,
                                                                        $request->gm_name,
                                                                        $request->gm_formatted_address,
                                                                        $request->gm_lat,
                                                                        $request->gm_lng);
                }
                \App\Libraries\Event::createEvent($request, $locale);
                return view('events/create');
        }

        public function getSearch() {
                return view('events/search');
        }
        
        public function postSearch(Request $request) {
                $all_events = \App\Event::with('kj')->with('locale')->get();
                $filtered_events = \App\Libraries\Event::filterByLocation($all_events,
                        floatval($request->gm_lat),
                        floatval($request->gm_lng),
                        floatval($request->radius));
                return view('events/search-ajax', ['events' => $filtered_events]);
        }

        public function getEdit($id) {
                $event = \App\Libraries\Event::getEvent($id);
                if (is_null($event)) {
                        \Session::flash('flash_message', 'No such event exists.');
                        return redirect ("/");
                }
                if ($event->kj->id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to edit this event.');
                        return redirect ("/");
                }
                return view('events/edit', ['event' => $event]);
        }
        
        public function postEdit(Request $request) {
                $this->validate($request, self::$rules, self::$messages);
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

        public function getDetail($id) {
                $event = \App\Libraries\Event::getEvent($id);
                if (is_null($event)) {
                        \Session::flash('flash_message', 'No such event exists.');
                }
                return view('events/detail', ['event' => $event]);
        }

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

        public function getConfirmDelete($id) {
                $event = \App\Libraries\Event::getEvent($id);
                if (is_null($event)) {
                        \Session::flash('flash_message', 'No such event exists.');
                        return redirect ("/");
                }
                if ($event->kj->id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to delete this event.');
                        return redirect ("/");
                }
                return view('events/delete-confirm', ['event' => $event]);
        }

        public function getDelete($id) {
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