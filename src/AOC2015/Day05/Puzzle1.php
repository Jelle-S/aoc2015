<?php

namespace Jelle_S\AOC\AOC2015\Day05;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  protected $rules = [];

  public function __construct(protected string $input) {
    $this->rules = [
      fn ($s) => strlen($s) - strlen(str_replace(['a', 'e', 'i', 'o', 'u'], '', $s)) >= 3,
      fn ($s) => (bool)preg_match('/([a-z])\1/', $s),
      fn ($s) => strlen($s) - strlen(str_replace(['ab', 'cd', 'pq', 'xy'], '', $s)) === 0,
    ];
  }

  public function solve() {
    $result = 0;

    $h = fopen($this->input, 'r');

    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      foreach ($this->rules as $rule) {
        if (!$rule($line)) {
          continue 2;
        }
      }
      $result++;
    }
    fclose($h);

    return $result;
  }
}
