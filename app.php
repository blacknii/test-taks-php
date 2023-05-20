<?php
require_once "game.php";

$game = new Game();
$frame = 1;
$isRollValid = false;

echo "Gra w kręgle: wprowadź liczbę strąconych kręgli w każdym rzucie i naciśnij Enter.\n";

while ($frame <= 10) {
  while (!$isRollValid) {
    echo "Frame {$frame}, rzut 1: ";
    $roll1 = (int) fgets(STDIN);
    if ($roll1 >= 0 && $roll1 <= 10) {
      $isRollValid = true;
    } else {
      echo "Błąd - Rzut może mieć wartość od 0 do 10 podaj wartość jeszcze raz." .
        "\n";
    }
  }
  $isRollValid = false;

  $game->roll($roll1);

  echo "Aktualna liczba punktów: " . $game->getScore() . "\n";

  if ($roll1 != 10 || $frame == 10) {
    while (!$isRollValid) {
      echo "Frame {$frame}, rzut 2: ";
      $roll2 = (int) fgets(STDIN);
      $roll2Max = 10 - ($roll1 % 10);
      if ($roll2 >= 0 && $roll2 <= $roll2Max) {
        $isRollValid = true;
      } else {
        echo "Błąd - Rzut może mieć wartość od 0 do " .
          $roll2Max .
          " podaj wartość jeszcze raz." .
          "\n";
      }
    }
    $isRollValid = false;

    $game->roll($roll2);
    echo "Aktualna liczba punktów: " . $game->getScore() . "\n";

    if ($frame == 10 && $roll1 + $roll2 >= 10) {
      while (!$isRollValid) {
        echo "Frame {$frame}, dodatkowy rzut: ";
        $extraRoll = (int) fgets(STDIN);
        $extraRollMax = ($roll1 + $roll2) % 10 ? 10 - $roll2 : 10;
        if ($extraRoll >= 0 && $extraRoll <= $extraRollMax) {
          $isRollValid = true;
        } else {
          echo "Błąd - Rzut może mieć wartość od 0 do " .
            $extraRollMax .
            " podaj wartość jeszcze raz." .
            "\n";
        }
      }
      $isRollValid = false;

      $game->roll($extraRoll);
    }
  }

  $frame++;
}

echo "Gra zakończona. Końcowa liczba punktów: " . $game->getScore() . "\n";

?>
