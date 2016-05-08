<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

        public function getCreate() {
                return view('users/create');
        }
        
        public function postCreate(Request $request) {
                return view('users/create');
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