<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kj_rating extends Model
{
        public function rater() {
                return $this->belongsTo('App\User', 'rater_id');
        }
        public function kj() {
                return $this->belongsTo('App\User', 'kj_id');
        }
}
