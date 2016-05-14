<?php
/*
 * Author:      Roland Galibert
 * Date:        May 13, 2016
 * For:         CSCI E-15 Dynamic Web Applications, Spring 2016 - Project 4
 * Purpose:     Various functionality supporting locale CRUD for KaraokeTracker web application
 */

namespace App\Libraries;

class Locale {

        /*
         * Function: getLocaleByID()
         * Purpose: Returns the locale record associated with the given ID,
         * along with associated rating records.
         */
         public static function getLocaleByID($locale_id) {
                $locale = \App\Locale::where('id', '=', $locale_id)->with('ratings')->first();
                return $locale;
        }

        /*
         * Function: getLocale()
         * Purpose: Returns the locale record associated with the given
         * Google Maps place_id.
         */
        public static function getLocale($gm_place_id) {
                $locale = \App\Locale::where('gm_place_id', '=', $gm_place_id)->first();
                return $locale;
        }

        /*
         * Function: createLocale()
         * Purpose: Executes actual DB creation of an locale, using the
         * Google Maps field passed in.
         */
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
