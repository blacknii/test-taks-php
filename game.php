<?php
class Game
{
  private $rolls = [];
  private $currentRoll = 0;

  public function roll(int $pins): void
  {
    $this->rolls[$this->currentRoll++] = $pins;
  }

  public function getScore(): int
  {
    $score = 0;
    $frameIndex = 0;

    for ($frame = 0; $frame < 10; $frame++) {
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
    }

    return $score;
  }

  private function isStrike(int $frameIndex): bool
  {
    return $this->rolls[$frameIndex] == 10;
  }

  private function isSpare(int $frameIndex): bool
  {
    return isset($this->rolls[$frameIndex], $this->rolls[$frameIndex + 1]) &&
      $this->rolls[$frameIndex] + $this->rolls[$frameIndex + 1] == 10;
  }

  private function strikeBonus(int $frameIndex): int
  {
    return $this->rolls[$frameIndex + 1] ??
      (0 + $this->rolls[$frameIndex + 2] ?? 0);
  }

  private function spareBonus(int $frameIndex): int
  {
    return $this->rolls[$frameIndex + 2] ?? 0;
  }

  private function sumOfPinsInFrame(int $frameIndex): int
  {
    return $this->rolls[$frameIndex] ??
      (0 + $this->rolls[$frameIndex + 1] ?? 0);
  }
}
?>
