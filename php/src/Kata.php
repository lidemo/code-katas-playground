<?php

namespace swkberlin;

class Kata
{

    protected $rolls = [];

    public function roll($pins)
    {
        $this->rolls[] = $pins;
    }

    public function score()
    {
        $score = 0;
        $roll = 0;
        
        for($i = 1; $i <= 10; $i += 2) {
            

            $score += $this->rolls[$roll] + $this->rolls[$roll + 1];
            
            $roll += 2;
        }

        return $score;

    }

}
