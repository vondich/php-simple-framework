<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

/**
 * Description of Utils
 *
 * @author nin
 */
class Utils
{
   public static function arrayValue($array, $key, $default = NULL)
   {
       return array_key_exists($key, $array) ? $array[$key] : $default;
   }
}


