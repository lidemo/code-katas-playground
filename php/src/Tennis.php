<?php

namespace swkberlin;

class Tennis
{
    const SCORE_NAMES = ['0' => 'love', '1' => 'fifteen', '2' => 'thirty', '3' => 'forty'];

    protected $player1 = 0;
    protected $player2 = 0;

    public function scorePoint(int $points, int $player) : void
    {
        if ($player == 1) {
            $this->player1 += $points;
        }
        
        if ($player == 2) {
            $this->player2 += $points;
        }
    }

    public function score() : String
    {
        $lead_points = abs($this->player1 - $this->player2);

        if ($this->hasWinner($lead_points)) {
            return 'winner ' . $this->leader();
        }

        if ($this->hasDeuce($lead_points)) {
            return 'deuce';
        }

        if ($this->hasAdvantage($lead_points)) {
            return 'advantage';
        }

        if (!$this->playersReachedThreshold()) {
            return self::SCORE_NAMES[$this->player1] . ':' . self::SCORE_NAMES[$this->player2];
        }
        
    }

    protected function hasWinner(int $lead_points) : bool
    {
        return $lead_points >= 2 && $this->playerPassedThreshold();
    }

    protected function playerPassedThreshold() : bool
    {
        return $this->player1 >= 3 || $this->player2 >= 3;
    }

    protected function playersReachedThreshold() : bool
    {
        return $this->player1 >= 3 && $this->player2 >= 3;
    }

    protected function leader() : String
    {
        return $this->player1 > $this->player2 ? 'player1' : 'player2';
    }

    protected function hasDeuce(int $lead_points) : bool
    {
        return $this->playerPassedThreshold() && $lead_points == 0;
    }

    protected function hasAdvantage($lead_points) : bool
    {
        return $this->playersReachedThreshold() && $lead_points == 1;
    }

}
