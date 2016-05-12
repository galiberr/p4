<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {
        private static $rules = [
            'user_name' => 'required|max:255|unique:users',
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
            'first_name.required_if' => 'First name required for KJ user.',
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

        public function getRegister() {
                return view('auth/register');
        }

        public function postRegister(Request $request) {
                $this->validate($request, self::$rules, self::$messages);
                $request->flash();
                $user = new \App\User();
                $user->user_name = $request->input('user_name');
                $user->password = \Hash::make($request->input('password'));
                $user->email = $request->input('email');
                $user->first_name = $request->input('first_name');
                $user->last_name = $request->input('last_name');
                $user->street_addr1 = $request->input('street_addr1');
                $user->street_addr2 = $request->input('street_addr2');
                $user->city = $request->input('city');
                $user->state = $request->input('state');
                $user->zip = $request->input('zip');
                $user->about_me = $request->input('about_me');
                $user->image = $request->hasFile('image') && $request->file('image')->isValid();
                $user->credit_card = $request->input('credit_card');
                $user->cc_exp_month = $request->input('cc_exp_month');
                $user->cc_exp_year = $request->input('cc_exp_year');
                $user->cc_csv = $request->input('cc_csv');
                $user->save();
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                        $request->file('image')->move(base_path() . '/public/assets/uploads/' . $user->id . '/', 'image');
                }
                return view('auth/register');
        }

        public function getSearch() {
                return view('');
        }

        public function postSearch(Request $request) {
                return view('');
        }

        public function getEdit() {
                return view('users/edit');
        }

        public function getDetail2() {
                return view('users/detail2');
        }

        public function postDetail2(Request $request) {
                return view('users/detail2');
        }

        public function getDetail() {
                return view('users/detail');
        }

        public function postDetail(Request $request) {
                return view('users/detail');
        }

}
