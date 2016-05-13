<?php

namespace App\Libraries;

class Locale {

         public static function getLocaleByID($locale_id) {
                $locale = \App\Locale::where('id', '=', $locale_id)->with('ratings')->first();
                return $locale;
        }

        public static function getLocale($gm_place_id) {
                $locale = \App\Locale::where('gm_place_id', '=', $gm_place_id)->first();
                return $locale;
        }

        public static function createLocale($gm_place_id, $gm_name, $gm_formatted_address, $gm_lat, $gm_lng) {
                $locale = new \App\Locale();
                $locale->gm_place_id = $gm_place_id;
                $locale->gm_name = $gm_name;
                $locale->gm_formatted_address = $gm_formatted_address;
                $locale->gm_lat = floatval($gm_lat);
                $locale->gm_lng = floatval($gm_lng);
                $locale->save();
                return $locale;
        }
}
