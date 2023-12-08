<?php

namespace Jelle_S\AOC\AOC2015\Day06;

class Puzzle2 extends Puzzle1 {

  protected function action($action, $value) {
    switch ($action) {
      case 'turn on':
        return $value + 1;

      case 'turn off':
        return max(0, $value - 1);

      case 'toggle':
        return $value + 2;
    }
  }
}
