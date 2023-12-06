<?php

namespace Jelle_S\AOC\AOC2015\Day03;

class Puzzle2 extends Puzzle1 {

  public function solve() {
    $result = 0;

    $line = trim(file_get_contents($this->input));
    $visited['0|0'] = true;
    $pos = [
      [0, 0],
      [0, 0],
    ];
    $moves = [
      '^' => [0, 1],
      '>' => [1, 0],
      'v' => [0, -1],
      '<' => [-1, 0],
    ];

    foreach (str_split($line) as $movenum => $move) {
      $santa = $movenum % 2;
      $pos[$santa] = [$pos[$santa][0] + $moves[$move][0], $pos[$santa][1] + $moves[$move][1]];
      $visited[implode('|', $pos[$santa])] = true;
    }

    return count($visited);
  }
}
