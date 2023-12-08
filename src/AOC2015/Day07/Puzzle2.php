<?php

namespace Jelle_S\AOC\AOC2015\Day07;

class Puzzle2 extends Puzzle1 {

  public function solve() {

    $h = fopen($this->input, 'r');
    $circuit = [];

    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      list($source, $wire) = explode(' -> ', $line);
      $circuit[$wire] = $source;
    }
    fclose($h);

    $circuit['b'] = $this->getValue('a', $circuit);
    $this->cache = [];
    $result = $this->getValue('a', $circuit);
    return $result;
  }
}
