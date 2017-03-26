<?php

namespace LAT\PHPToolbox;

/**
 * Description of newPHPClass
 *
 * @author ncastro
 */
class DataRenderer {

  public static function toList($items, $proto = 'ul') {
    $s = "<$proto>";
    foreach ($items as $e) {
      $s .= '<li>' . $e . '</li>';
    }
    $s .= "</$proto>";

    return $s;
  }

  public static function toTable($headers, $rows, $mapping) {
    $s = '<table><thead><tr><th>' . implode('</th><th>', $headers) . '</th></tr></thead><tbody>';
    foreach ($rows as $rk => $rv) {
      $s .= '<tr>';

      $record = is_object($rv) ? get_object_vars($rv) : $rv;

      foreach ($mapping as $mk => $mv) {
        if (array_key_exists($mk, $record)) {
          $s .= '<td>';
          if (is_null($mapping[$mk])) {
            $s .= $record[$mk];
          } elseif (is_callable($mapping[$mk])) {
            $s .= $mapping[$mk]($record[$mk]);
          } else {
            $s .= var_export($record[$mk], true);
          }
          $s .= '</td>';
        }
      }
      $s .= '</tr>';
    }
    $s .= '</tbody></table>';

    return $s;
  }

}
