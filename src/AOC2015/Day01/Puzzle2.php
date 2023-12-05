<?php

namespace Jelle_S\AOC\AOC2015\Day01;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;
    $h = fopen($this->input, 'r');
    $line = trim(fgets($h));
    fclose($h);
    $floor = 0;
    foreach (str_split($line) as $key => $char) {
      $floor += $char === '(' ? 1 : -1;
      if ($floor === -1) {
        break;
      }
    }
    $result = $key + 1;
    return $result;
  }
}