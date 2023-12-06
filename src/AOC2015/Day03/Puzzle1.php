<?php

namespace Jelle_S\AOC\AOC2015\Day03;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    $line = trim(file_get_contents($this->input));
    $visited['0|0'] = true;
    $pos = [0,0];
    $moves = [
      '^' => [0, 1],
      '>' => [1, 0],
      'v' => [0, -1],
      '<' => [-1, 0],
    ];

    foreach (str_split($line) as $move) {
      $pos = [$pos[0] + $moves[$move][0], $pos[1] + $moves[$move][1]];
      $visited[implode('|', $pos)] = true;
    }

    return count($visited);
  }
}
