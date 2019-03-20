<?php
/**
 * Created by PhpStorm.
 * User: Acs
 * Date: 10/12/2018
 * Time: 09:54
 */

namespace App\Helpers;


use Illuminate\Support\Facades\Config;

class Helper {


   public static function url(string $string) {
      if(substr($string, 0, 1) === "/") {
         $string = ltrim($string, '/');
      }
      if(Config::get('app.locale_prefix') != "") {
         $string = url('/') . '/' . Config::get('app.locale_prefix') . '/' . $string;
      } else {
         $string = url('/') . '/' . $string;
      }
      return $string;
   }

   public static function getDateFormat($date) {
      if($date != null) {
         $date_parts = explode('-', $date);
         return $date_parts[2] . '/' . $date_parts[1] . '/' . $date_parts[0];
      } else {
         return null;//''
      }
   }


   public static function setDateFormat($date) {
      if($date != null) { //''
         $date_parts = explode('/', $date);
         return $date_parts[2] . '-' . $date_parts[1] . '-' . $date_parts[0];
      } else {
         return null; //''
      }
   }
}