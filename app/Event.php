<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
        public function kj() {
                return $this->belongsTo('App\User');
        }
        
        public function locale() {
                return $this->belongsTo('App\Locale');
        }
        
        public function posts() {
                return $this->hasMany('App\Event_post');
        }
        
}