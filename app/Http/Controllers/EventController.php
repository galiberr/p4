<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller {
        private static $rules = [
            'title' => 'required',
            'descripton' => 'required',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|max:255|unique:users',
            'first_name' => 'required_if:inputUserType,0',
            'last_name' => 'required_if:inputUserType,0',
            'street_addr1' => 'required_if:inputUserType,0',
            // 'street_addr2' => 'required_if:inputUserType,0',
            'city' => 'required_if:inputUserType,0',
            'state' => 'required_if:inputUserType,0',
            'zip' => 'required_if:inputUserType,0',
            // 'about_me' => '',
            'credit_card' => 'required_if:inputUserType,0',
            'cc_exp_month' => 'required_if:inputUserType,0|numeric|min:1|max:12',
            'cc_exp_year' => 'required_if:inputUserType,0|numeric',
            'cc_csv' => 'required_if:inputUserType,0|numeric',
        ];
        private static $messages = [
            'title.required' => 'Event must have a title.',
            'description.required' => 'Event must have a description.',
            'last_name.required_if' => 'Last name required for KJ user.',
            'street_addr1.required_if' => 'Full address required for KJ user.',
            'city.required_if' => 'Full address required for KJ user.',
            'state.required_if' => 'Full address required for KJ user.',
            'zip.required_if' => 'Full address required for KJ user.',
            'credit_card.required_if' => 'Credit card required for KJ user.',
            'cc_exp_month.required_if' => 'Credit card expiration month required for KJ user.',
            'cc_exp_year.required_if' => 'Credit card expiration year required for KJ user.',
            'cc_csv.required_if' => 'Credit card csv required for KJ user.',
        ];

        public function getCreate() {
                return view('events/create');
        }
        
        public function postCreate(Request $request) {
                $this->validate($request, self::$rules, self::$messages);
                $request->flash();
                $event = new \App\Event();
                // $user->user_name = $request->input('user_name');
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                        $request->file('image')->move(base_path() . '/public/assets/uploads/' . $user->id . '/', 'image');
                }
                return view('events/create');
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
                return view('events/edit');
        }
        
        public function postEdit(Request $request) {
                return view('events/edit');
        }

        public function getDetail() {
                return view('events/detail');
        }

        public function postDetail(Request $request) {
                return view('events/detail');
        }

}