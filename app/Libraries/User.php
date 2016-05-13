<?php

namespace App\Libraries;
use Intervention\Image\ImageManager;

class User {
        public static function getUser($user_id) {
                $user = \App\User::where('id', '=', $user_id)->with('roles')->with('events')->with('ratings')->first();
                return $user;
        }
        
        public static function createUser($request) {
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
                switch (intval($request->inputUserType)) {
                        case 0:
                                $role = \App\Role::where('id', '=', 2)->first();
                                $user->roles()->save($role);
                                break;
                        case 1:
                                $role = \App\Role::where('id', '=', 3)->first();
                                $user->roles()->save($role);
                                break;
                }
                
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                        $request->file('image')->move(base_path() . '/public/assets/uploads/users/' . $user->id . '/', 'original');
                        \App\Libraries\User::generateDisplayImage(base_path() . '/public/assets/uploads/users/' . $user->id . '/original',
                                base_path() . '/public/assets/uploads/users/' . $user->id . '/display_image');
                        \App\Libraries\User::generateThumbnail(base_path() . '/public/assets/uploads/users/' . $user->id . '/original',
                                base_path() . '/public/assets/uploads/users/' . $user->id . '/thumbnail');
                }
                return $user;
        }
        
        public static function updateUser($userID, $request) {
                $user = \App\Libraries\User::getUser($userID);
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
                if (!$user->image) {
                        $user->image = $request->hasFile('image') && $request->file('image')->isValid();
                }
                $user->credit_card = $request->input('credit_card');
                $user->cc_exp_month = $request->input('cc_exp_month');
                $user->cc_exp_year = $request->input('cc_exp_year');
                $user->cc_csv = $request->input('cc_csv');
                $user->save();
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                        $request->file('image')->move(base_path() . '/public/assets/uploads/users/' . $user->id . '/', 'original');
                        \App\Libraries\User::generateDisplayImage(base_path() . '/public/assets/uploads/users/' . $user->id . '/original',
                                base_path() . '/public/assets/uploads/users/' . $user->id . '/display_image');
                        \App\Libraries\User::generateThumbnail(base_path() . '/public/assets/uploads/users/' . $user->id . '/original',
                                base_path() . '/public/assets/uploads/users/' . $user->id . '/thumbnail');
                }
        }
        
        public static function generateDisplayImage($sourceFile, $targetFile) {
                $height = 150;
                $width = 150;
                $manager = new ImageManager();
                $img = $manager->make($sourceFile);
                $img->fit($height, $width);
                $img->save($targetFile);
                return;
        }
        
        public static function generateThumbnail($sourceFile, $targetFile) {
                $height = 30;
                $width = 30;
                $manager = new ImageManager();
                $img = $manager->make($sourceFile);
                $img->fit($height, $width);
                $img->save($targetFile);
                return;
        }
        
        public static function generateSampleImages() {
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/users/1/original',
                        base_path() . '/public/assets/uploads/users/1/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/users/1/original',
                        base_path() . '/public/assets/uploads/users/1/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/users/2/original',
                        base_path() . '/public/assets/uploads/users/2/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/users/2/original',
                        base_path() . '/public/assets/uploads/users/2/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/users/3/original',
                        base_path() . '/public/assets/uploads/users/3/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/users/3/original',
                        base_path() . '/public/assets/uploads/users/3/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/users/4/original',
                        base_path() . '/public/assets/uploads/users/4/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/users/4/original',
                        base_path() . '/public/assets/uploads/users/4/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/users/5/original',
                        base_path() . '/public/assets/uploads/users/5/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/users/5/original',
                        base_path() . '/public/assets/uploads/users/5/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events/1/original',
                        base_path() . '/public/assets/uploads/events/1/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events/1/original',
                        base_path() . '/public/assets/uploads/events/1/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events/2/original',
                        base_path() . '/public/assets/uploads/events/2/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events/2/original',
                        base_path() . '/public/assets/uploads/events/2/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events/3/original',
                        base_path() . '/public/assets/uploads/events/3/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events/3/original',
                        base_path() . '/public/assets/uploads/events/3/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events/4/original',
                        base_path() . '/public/assets/uploads/events/4/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events/4/original',
                        base_path() . '/public/assets/uploads/events/4/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events/5/original',
                        base_path() . '/public/assets/uploads/events/5/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events/5/original',
                        base_path() . '/public/assets/uploads/events/5/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events/6/original',
                        base_path() . '/public/assets/uploads/events/6/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events/6/original',
                        base_path() . '/public/assets/uploads/events/6/thumbnail');
                \App\Libraries\Event::generateDisplayImage(base_path() . '/public/assets/uploads/events/7/original',
                        base_path() . '/public/assets/uploads/events/7/display_image');
                \App\Libraries\Event::generateThumbnail(base_path() . '/public/assets/uploads/events/7/original',
                        base_path() . '/public/assets/uploads/events/7/thumbnail');
                return;
        }
        
        public static function sendRegistrationEmail($user) {
                \Mail::send([], [], function ($message) use($user) {
                        $message->to($user->email)
                                ->subject('Welcome to KaraokeTracker!')
                                ->setBody('Welcome to KaraokeTracker, ' . $user->user_name . '! ' .
                                        'We hope you will enjoy the full set of functionality KaraokeTracker has to offer. '
                                        . 'Happy singing! KaraokeTracker'
                                        );
                });
        }
}
