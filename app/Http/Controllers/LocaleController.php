<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller {

        public function getSearch() {
                return view('locales/search');
        }
        
        public function postSearch(Request $request) {
                return view('locales/search');
        }

        public function getDetail() {
                return view('locales/detail');
        }

        public function postDetail(Request $request) {
                return view('locales/detail');
        }

}