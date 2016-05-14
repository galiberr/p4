<?php
/*
 * Author:      Roland Galibert
 * Date:        May 13, 2016
 * For:         CSCI E-15 Dynamic Web Applications, Spring 2016 - Project 4
 * Purpose:     Controller for local detail views for 
 *              KaraokeTracker web application (locales are created automatically
 *              as necessary during event creation.
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocaleController extends Controller {

        /*
         * Function: getDetail()
         * Purpose: Calls view for creating a karaoke event
         */
        public function getDetail($id) {

                /*
                 * Retrieve the locale requested and indicate if it does not
                 * exist.
                 */
                $locale = \App\Libraries\Locale::getLocaleByID($id);
                if (is_null($locale)) {
                        \Session::flash('flash_message', 'No such locale exists.');
                }
                return view('locales/detail', ['locale' => $locale]);
        }

        /*
         * Function: postDetail()
         * Purpose: Saves a user rating entered to a locale detail page then
         * calls the AJAX view to immediately display in to the page.
         */
        public function postDetail(Request $request) {
                $new_rating = new \App\Locale_rating();
                $new_rating->locale_id = intval($request->locale_id);
                $new_rating->rater_id = \Auth::user()->id;
                $new_rating->rating = intval($request->locale_rating);
                $new_rating->comment = $request->locale_comment;
                $new_rating->save();
                $locale = \App\Libraries\Locale::getLocaleByID($request->locale_id);
                return view('locales/detail-ajax', ['locale' => $locale]);
        }

}