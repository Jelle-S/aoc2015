<?php

namespace Jelle_S\AOC\AOC2015\Day04;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;

    $line = trim(file_get_contents($this->input));
    while (++$result) {
      if (substr(md5($line . $result), 0, 6) === '000000') {
        return $result;
      }
    }
  }
}
