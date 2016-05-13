<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
        public function ratings() {
                return $this->hasMany('\App\Locale_rating', 'locale_id');
        }
}
