<?php

namespace Jelle_S\AOC\AOC2015\Day01;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  public function __construct(protected string $input) {
  }

  public function solve() {
    $result = 0;
    $h = fopen($this->input, 'r');
    $line = trim(fgets($h));
    fclose($h);
    $down = strlen(str_replace('(', '', $line));
    $up = strlen($line) - $down;
    $result = $up - $down;
    return $result;
  }
}