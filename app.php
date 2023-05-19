<?php

require_once "game.php";

$game = new Game();
$frame = 1;
$isGameOver = false;

echo "Gra w kręgle: wprowadź liczbę strąconych kręgli w każdym rzucie i naciśnij Enter.\n";

while ($frame <= 10) {
  echo "Frame {$frame}, rzut 1: ";
  $roll1 = (int) fgets(STDIN);

  $game->roll($roll1);
  echo "Aktualna liczba punktów: " . $game->getScore() . "\n";

  if ($roll1 != 10 || $frame == 10) {
    echo "Frame {$frame}, rzut 2: ";
    $roll2 = (int) fgets(STDIN);

    $game->roll($roll2);
    echo "Aktualna liczba punktów: " . $game->getScore() . "\n";

    if ($frame == 10 && $roll1 + $roll2 >= 10) {
      echo "Frame {$frame}, dodatkowy rzut: ";
      $extraRoll = (int) fgets(STDIN);
      $game->roll($extraRoll);
    }
  }

  $frame++;
}

echo "Gra zakończona. Końcowa liczba punktów: " . $game->getScore() . "\n";

?>
