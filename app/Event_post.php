<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_post extends Model
{
        public function poster() {
                return $this->belongsTo('App\User');
        }
}
