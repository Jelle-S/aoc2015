<?php

namespace Jelle_S\AOC\AOC2015\Day02;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    return array_reduce(
      array_map(function($b) { sort($b); return $b; }, array_map(fn($a) => explode('x', $a), explode("\n", trim(file_get_contents($this->input))))),
      function ($carry, $item) {
        $area = 0;
        foreach ($item as $key => $dimension) {
          $area += 2 * $item[$key] * $item[($key+1)%3];
        }
        $area += $item[0] * $item[1];

        return $carry + $area;
      },
      $result
    );
  }
}