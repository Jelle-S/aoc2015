<?php

namespace Jelle_S\AOC\AOC2015\Day07;

use Jelle_S\AOC\Contracts\PuzzleInterface;

class Puzzle1 implements PuzzleInterface {

  protected $cache = [];

  public function __construct(protected string $input) {
  }

  public function solve() {

    $h = fopen($this->input, 'r');
    $circuit = [];

    while (($line = fgets($h)) !== false) {
      $line = trim($line);
      list($source, $wire) = explode(' -> ', $line);
      $circuit[$wire] = $source;
    }
    fclose($h);

    $result =  $this->getValue('a', $circuit);

    return $result;
  }

  protected function getValue($wire, $circuit) {
    if (array_key_exists($wire, $this->cache)) {
      return $this->cache[$wire];
    }
    if (is_numeric($circuit[$wire])) {
      $this->cache[$wire] = (int)$circuit[$wire];
      return $this->cache[$wire];
    }

    switch (true) {
      case str_contains($circuit[$wire], 'LSHIFT'):
        list($sourceWire, $bits) = explode(' LSHIFT ', $circuit[$wire]);
        $this->cache[$wire] = is_numeric($sourceWire) ? ((int)$sourceWire) << $bits : $this->getValue($sourceWire, $circuit) << $bits;
        break;

      case str_contains($circuit[$wire], 'RSHIFT'):
        list($sourceWire, $bits) = explode(' RSHIFT ', $circuit[$wire]);
        $this->cache[$wire] = is_numeric($sourceWire) ? ((int)$sourceWire) >> $bits : $this->getValue($sourceWire, $circuit) >> $bits;
        break;

      case str_contains($circuit[$wire], 'NOT'):
        // PHP's bitwise not operator is... Weird
        $sourceWire = str_replace('NOT ', '', $circuit[$wire]);
        $this->cache[$wire] = $this->bitwiseNot(is_numeric($sourceWire) ? (int)$sourceWire : (int)$this->getValue($sourceWire, $circuit));
        break;

      case str_contains($circuit[$wire], 'AND'):
        list($sourceWireA, $sourceWireB) = explode(' AND ', $circuit[$wire]);
        $sourceWireA = is_numeric($sourceWireA) ? (int) $sourceWireA : $this->getValue($sourceWireA, $circuit);
        $sourceWireB = is_numeric($sourceWireB) ? (int) $sourceWireB : $this->getValue($sourceWireB, $circuit);
        $this->cache[$wire] = $sourceWireA & $sourceWireB;
        break;

      case str_contains($circuit[$wire], 'OR'):
        list($sourceWireA, $sourceWireB) = explode(' OR ', $circuit[$wire]);
        $sourceWireA = is_numeric($sourceWireA) ? (int) $sourceWireA : $this->getValue($sourceWireA, $circuit);
        $sourceWireB = is_numeric($sourceWireB) ? (int) $sourceWireB : $this->getValue($sourceWireB, $circuit);
        $this->cache[$wire] = $sourceWireA | $sourceWireB;
        break;

      default:
        $this->cache[$wire] = $this->getValue($circuit[$wire], $circuit);
        break;
    }

    return $this->cache[$wire];
  }

  protected function bitwiseNot(int $val) {
    $mask = bindec(str_repeat('1', 16));
    return $val ^ $mask;
  }
}
