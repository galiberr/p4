<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocaleController extends Controller {

        public function getSearch() {
                return view('locales/search');
        }
        
        public function postSearch(Request $request) {
                return view('locales/search');
        }

        public function getDetail($id) {
                $locale = \App\Libraries\Locale::getLocaleByID($id);
                if (is_null($locale)) {
                        \Session::flash('flash_message', 'No such locale exists.');
                }
                return view('locales/detail', ['locale' => $locale]);
        }

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