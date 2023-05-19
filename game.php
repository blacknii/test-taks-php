<?php
class Game
{
  private $rolls = [];
  private $currentRoll = 0;

  public function roll(int $pins): void
  {
    $this->rolls[] = $pins;
    echo var_dump($this->rolls);
  }

  public function getScore(): int
  {
    $score = 0;
    $frameIndex = 0;
    $numberOfRolls = count($this->rolls);

    echo "number of rolls = " . $numberOfRolls . "\n";
    echo "frameIndex = " . $frameIndex . "\n";

    for ($frame = 0; $frameIndex < $numberOfRolls - 1; $frame++) {
      if ($this->isStrike($frameIndex)) {
        $score += 10 + $this->strikeBonus($frameIndex);
        $frameIndex++;
      } elseif ($this->isSpare($frameIndex)) {
        $score += 10 + $this->spareBonus($frameIndex);
        $frameIndex += 2;
      } else {
        $score += $this->sumOfPinsInFrame($frameIndex);
        $frameIndex += 2;
      }
      echo "frameIndex = " . $frameIndex . "\n";
    }

    return $score;
  }

  private function isStrike(int $frameIndex): bool
  {
    return $this->rolls[$frameIndex] == 10;
  }

  private function isSpare(int $frameIndex): bool
  {
    return $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1] == 10;
  }

  private function strikeBonus(int $frameIndex): int
  {
    $bonus = 0;
    if (isset($this->rolls[$frameIndex + 1])) {
      $bonus += $this->rolls[$frameIndex + 1];
    }
    if (isset($this->rolls[$frameIndex + 2])) {
      $bonus += $this->rolls[$frameIndex + 2];
    }
    return $bonus;
  }

  private function spareBonus(int $frameIndex): int
  {
    if (isset($this->rolls[$frameIndex + 2])) {
      return $this->rolls[$frameIndex + 2];
    }
    return 0;
  }

  private function sumOfPinsInFrame(int $frameIndex): int
  {
    $sum = 0;
    if (isset($this->rolls[$frameIndex])) {
      $sum += $this->rolls[$frameIndex];
    }
    if (isset($this->rolls[$frameIndex + 1])) {
      $sum += $this->rolls[$frameIndex + 1];
    }
    return $sum;
  }
}
?>
