<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locale_rating extends Model
{
        public function rater() {
                return $this->belongsTo('App\User', 'rater_id');
        }
}
