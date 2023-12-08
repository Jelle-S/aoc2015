<?php

namespace Jelle_S\AOC\AOC2015\Day06;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');
    // 1000 x 1000 grid.
    $grid = array_fill(0, 1000, array_fill(0, 1000, 0));

    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      $matches = [];
      preg_match('/(turn on|turn off|toggle) (\d+),(\d+) through (\d+),(\d+)/', $line, $matches);
      list(, $instruction, $x1, $y1, $x2, $y2) = $matches;
      for ($x = $x1; $x <= $x2; $x++) {
        for ($y = $y1; $y <= $y2; $y++) {
          $grid[$x][$y] = $this->action($instruction, $grid[$x][$y]);
        }
      }
    }
    fclose($h);
    foreach ($grid as $row) {
      $result += array_sum($row);
    }
    return $result;
  }

  protected function action($action, $value) {
    switch ($action) {
      case 'turn on':
        return 1;

      case 'turn off':
        return 0;

      case 'toggle':
        return (int)(!(bool)$value);
    }
  }
}
