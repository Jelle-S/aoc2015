<?php

namespace Jelle_S\AOC\AOC2015\Day04;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    $line = trim(file_get_contents($this->input));
    while (++$result) {
      if (substr(md5($line . $result), 0, 5) === '00000') {
        return $result;
      }
    }
  }
}
