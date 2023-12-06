<?php

namespace Jelle_S\AOC\AOC2015\Day05;

class Puzzle2 extends Puzzle1 {

  public function __construct(protected string $input) {
    $this->rules = [
      fn ($s) => strlen($s) - strlen(preg_replace('/((([a-z]){2})([^\2]*)(\2))*/', '', $s)) > 0,
      fn ($s) => strlen($s) - strlen(preg_replace('/(([a-z]).\2)*/', '', $s)) > 0,
    ];
  }
}
