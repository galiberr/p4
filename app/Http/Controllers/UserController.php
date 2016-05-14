<?php
/*
 * Author:      Roland Galibert
 * Date:        May 13, 2016
 * For:         CSCI E-15 Dynamic Web Applications, Spring 2016 - Project 4
 * Purpose:     Controller for user CRUD views for KaraokeTracker web application
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

        /*
         * Input validation rules (user creation)
         */
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
        
        /*
         * Input validation rules (user edit)
         */
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
        
        /*
         * Input validation error messages
         */
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

        /*
         * Function: getCreate()
         * Purpose: Calls general application landing page view
         */
        public function getIndex() {
                return view('index');
        }

        /*
         * Function: getCreate()
         * Purpose: Calls view for creating a KaraokeTracker user
         */
        public function getRegister() {
                return view('auth/register');
        }

        /*
         * Function: postCreate()
         * Purpose: Processes user creation form input
         */
         public function postRegister(Request $request) {
                $this->validate($request, self::$rules, self::$messages);
                $request->flash();
                $user = \App\Libraries\User::createUser($request);
                
                /*
                 * Send registration confirmation email
                 */
                \App\Libraries\User::sendRegistrationEmail($user);
                return view('auth/register');
        }

        /*
         * Function: getEdit()
         * Purpose: Calls view to edit a KTracker user
         */
        public function getEdit($id) {
                
                /*
                 * Make sure this ID is the ID of the logged in user.
                 */
                if ($id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to this page.');
                        return redirect('/');
                }
                
                /*
                 * Retrieve the user record, indicating if no such record actually
                 * exists.
                 */
                $user = \App\Libraries\User::getUser($id);
                if (is_null($user)) {
                        \Session::flash('flash_message', 'No such user exists.');
                        return redirect('/');
                }
                return view('users/edit', ['user' => $user]);
        }

        /*
         * Function: postEdit()
         * Purpose: Processes KTracker user edit form input
         */
        public function postEdit(Request $request) {
                $this->validate($request, self::$editRules, self::$messages);
                $request->flash();
                \App\Libraries\User::updateUser(\Auth::user()->id, $request);
                \Session::flash('flash_message', 'Your user information has been updated.');
                return view('users/edit');
        }

        /*
         * Function: getEditMyProfile()
         * Purpose: Redirects the logged in user to the view form
         * to edit his/her own profile.
         */
        public function getEditMyProfile() {
                return redirect ('users/' . \Auth::user()->id . '/edit');
        }

        /*
         * Function: getDetail()
         * Purpose: Calls view to display the detail for the KTracker user with
         * the specified ID.
         */
        public function getDetail($id) {
                $user = \App\Libraries\User::getUser($id);
                if (is_null($user)) {
                        \Session::flash('flash_message', 'No such user exists.');
                }
                return view('users/detail', ['user' => $user]);
        }

        /*
         * Function: postDetail()
         * Purpose: Saves a rating entered to a user detail page then
         * calls the AJAX view to immediately display in to the page. The
         * form to enter a rating will only be displayed if the user associated
         * with the detail page is a KJ.
         */
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

        /*
         * Function: getConfirmDelete()
         * Purpose: Performs initial processing for a user deletion request
         * submitted by a user.
         */
        public function getConfirmDelete($id) {
                $user = \App\Libraries\User::getUser($id);

                /*
                 * Return error messages if the user does not actually exist
                 * or if this ID is not the ID of the associated user.
                 */
                if (is_null($user)) {
                        \Session::flash('flash_message', 'You are not authorized to this action.');
                        return redirect ("/");
                }
                if ($user->id != \Auth::user()->id) {
                        \Session::flash('flash_message', 'You are not authorized to this action.');
                        return redirect ("/");
                }
                
                /*
                 * Call the delete confirmation view.
                 */
                return view('users/delete-confirm', ['user' => $user]);
        }

        /*
         * Function: getDelete()
         * Purpose: Performs actual deletion for an user deletion request
         * submitted by a user (i.e. to delete his/her own KTracker profile
         * from the system.
         */
        public function getDelete($id) {
                $user = \App\Libraries\User::getUser($id);
                
                /*
                 * Retrieve the user record and output error messages if it does not
                 * exist or if the logged in user is not authorized to delete it.
                 */
                if (is_null($user)) {
                        \Session::flash('flash_message', 'You are not authorized to this action.');
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
