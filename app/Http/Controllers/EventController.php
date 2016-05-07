<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller {

        public function getCreate() {
                $test = [];
                $test['placeResult']['place_id'] = "Get place_id";
                $test['placeResult']['name'] = "Get name";
                $test['placeResult']['formatted_address'] = "Get address";
                $test['placeResult']['geometry']['location']['lat'] = "Get lat";
                $test['placeResult']['geometry']['location']['lng'] = "Get lng";
                return view('events/create', ['test' => $test]);
        }
        
        public function postCreate(Request $request) {
                $test = json_decode($request->input('placeResult'), true);
                return view('events/create', ['test' => $test]);
        }

        public function getSearch() {
                $test = [];
                $test['placeResult']['place_id'] = "Get place_id";
                $test['placeResult']['name'] = "Get name";
                $test['placeResult']['formatted_address'] = "Get address";
                $test['placeResult']['geometry']['location']['lat'] = "Get lat";
                $test['placeResult']['geometry']['location']['lng'] = "Get lng";
                return view('events/search', ['test' => $test]);
        }
        
        public function postSearch(Request $request) {
                $test = json_decode($request->input('placeResult'), true);
                return view('events/search-ajax', ['test' => $test]);
        }

        public function getEdit() {
                return view('');
        }
        
        public function postEdit(Request $request) {
                return view('');
        }

        public function getDetail() {
                return view('');
        }

        public function postDetail(Request $request) {
                return view('');
        }

}