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
        private static $editRules = [
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|max:255:users',
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
                $user = \App\Libraries\User::createUser($request);
                \App\Libraries\User::sendRegistrationEmail($user);
                return view('auth/register');
        }

        public function getSearch() {
                return view('');
        }

        public function postSearch(Request $request) {
                return view('');
        }

        public function getEdit($id) {
                if ($id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to this page.');
                        return redirect('/');
                }
                $user = \App\Libraries\User::getUser($id);
                if (is_null($user)) {
                        \Session::flash('flash_message', 'No such user exists.');
                        return redirect('/');
                }
                return view('users/edit', ['user' => $user]);
        }

        public function postEdit(Request $request) {
                $this->validate($request, self::$editRules, self::$messages);
                $request->flash();
                \App\Libraries\User::updateUser(\Auth::user()->id, $request);
                \Session::flash('flash_message', 'Your user information has been updated.');
                return view('users/edit');
        }

        public function getEditMyProfile() {
                return redirect ('users/' . \Auth::user()->id . '/edit');
        }

        public function getDetail($id) {
                $user = \App\Libraries\User::getUser($id);
                if (is_null($user)) {
                        \Session::flash('flash_message', 'No such user exists.');
                }
                return view('users/detail', ['user' => $user]);
        }

        public function postDetail(Request $request) {
                $new_rating = new \App\Kj_rating();
                $new_rating->kj_id = intval($request->kj_id);
                $new_rating->rater_id = \Auth::user()->id;
                $new_rating->rating = intval($request->kj_rating);
                $new_rating->comment = $request->kj_comment;
                $new_rating->save();
                $user = \App\Libraries\User::getUser($request->kj_id);
                return view('users/detail-ajax', ['user' => $user]);
        }

        public function getConfirmDelete($id) {
                $user = \App\Libraries\User::getUser($id);
                if (is_null($user)) {
                        \Session::flash('flash_message', 'No such user exists.');
                        return redirect ("/");
                }
                if ($user->id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to this action.');
                        return redirect ("/");
                }
                return view('users/delete-confirm', ['user' => $user]);
        }

        public function getDelete($id) {
                $user = \App\Libraries\User::getUser($id);
                if (is_null($user)) {
                        \Session::flash('flash_message', 'No such user exists.');
                        return redirect ("/");
                }
                if ($user->id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to this action.');
                        return redirect ("/");
                }
                $user->delete();
                return redirect("/");
        }
}
