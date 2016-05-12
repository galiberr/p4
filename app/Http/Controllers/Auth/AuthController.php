<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
        /*
          |--------------------------------------------------------------------------
          | Registration & Login Controller
          |--------------------------------------------------------------------------
          |
          | This controller handles the registration of new users, as well as the
          | authentication of existing users. By default, this controller uses
          | a simple trait to add these behaviors. Why don't you explore it?
          |
         */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

# Where should the user be redirected to if their login fails?

        protected $loginPath = '/login';

# Where should the user be redirected to after logging out?
        protected $redirectAfterLogout = '/';

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
        protected $redirectTo = '/';
        
        protected $username = 'user_name';
        
        /**
         * Create a new authentication controller instance.
         *
         * @return void
         */
        public function __construct() {
                $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        }

        /**
         * Get a validator for an incoming registration request.
         *
         * @param  array  $data
         * @return \Illuminate\Contracts\Validation\Validator
         */
        protected function validator(array $data) {
                /*
                return Validator::make($data, [
                    'user_id' => 'required|max:255|unique:users',
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
                ],
                        [
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
                            ]
                        );
                 * 
                 */
        }

        /**
         * Create a new user instance after a valid registration.
         *
         * @param  array  $data
         * @return User
         */
        protected function create(array $data) {
                /*
                if(\Input::hasfile($data['image'])){
                        $image = Input::file($data['image']);
                        $upload = base_path().'/assets/uploads/';
                        $filename = 'image.jpg';
                        $image->move($upload, $filename);
                        $path = $upload.$filename;
                }
                 * 
                 */
                /*
                echo \Request::input('user_id');
                return User::create([
                    'user_id' => $data['user_id'],
                    'password' => $data['password'],
                    'email' => $data['email'],
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'street_addr1' => $data['street_addr1'],
                    'street_addr2' => $data['street_addr2'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'zip' => $data['zip'],
                    'about_me' => $data['about_me'],
                    'credit_card' => $data['credit_card'],
                    'cc_exp_month' => $data['cc_exp_month'],
                    'cc_exp_year' => $data['cc_exp_year'],
                ]);
                 * 
                 */
        }

}
