<?php

namespace LAT\PHPToolbox;

/**

 * @author ncastro
 */
class Text {

  public static function normalize($v) {
    $s = trim($v);
    $s = mb_strtolower($s);
    $s = iconv('UTF-8', 'ASCII//TRANSLIT', $s); //replace accents
    $s = str_replace(str_split('.:\\/*?"<>|%&$#=\'^´`'), '', $s); //replace invalid characters
    $s = preg_replace('!\s+!', ' ', $s); //replace multiple spaces
    $s = str_replace(' ', '_', $s); //replace space by a valid char
    return $s;
  }

}
