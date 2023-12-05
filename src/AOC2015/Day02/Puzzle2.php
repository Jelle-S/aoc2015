<?php

namespace Jelle_S\AOC\AOC2015\Day02;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;
    return array_reduce(
      array_map(function($b) { sort($b); return $b; }, array_map(fn($a) => explode('x', $a), explode("\n", trim(file_get_contents($this->input))))),
      function ($carry, $item) {
        $ribbon = 2 * $item[0] + 2 * $item[1] + $item[0] * $item[1] * $item[2];

        return $carry + $ribbon;
      },
      $result
    );
  }
}