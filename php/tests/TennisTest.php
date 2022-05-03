<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use swkberlin\Tennis;

class TennisTest extends TestCase
{

    public function testZeroScores()
    {
        $tennisGame = new Tennis();

        $this->assertEquals('love:love', $tennisGame->score());
    }

    public function testOneToZeroScores()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(1, 1);

        $this->assertEquals('fifteen:love', $tennisGame->score());
    }

    public function testOneToTwoScores()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(1, 1);
        $tennisGame->scorePoint(2, 2);

        $this->assertEquals('fifteen:thirty', $tennisGame->score());
    }

    public function testThreeToTwoScores()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(3, 1);
        $tennisGame->scorePoint(2, 2);

        $this->assertEquals('forty:thirty', $tennisGame->score());
    }

    public function testGameIsDuce()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(3, 1);
        $tennisGame->scorePoint(3, 2);

        $this->assertEquals('deuce', $tennisGame->score());
    }

    public function testGameIsDucePastTreshold()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(6, 1);
        $tennisGame->scorePoint(6, 2);

        $this->assertEquals('deuce', $tennisGame->score());
    }

    public function testPlayerOneAdvantage()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(4, 1);
        $tennisGame->scorePoint(3, 2);

        $this->assertEquals('advantage', $tennisGame->score());
    }

    public function testPlayerTwoAdvantage()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(6, 1);
        $tennisGame->scorePoint(7, 2);

        $this->assertEquals('advantage', $tennisGame->score());
    }

    public function testPlayerOneWinnerWithoutDuce()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(4, 1);
        $tennisGame->scorePoint(1, 2);

        $this->assertEquals('winner player1', $tennisGame->score());
    }

    public function testPlayerOneWinnerWithDuce()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(6, 1);
        $tennisGame->scorePoint(4, 2);

        $this->assertEquals('winner player1', $tennisGame->score());
    }

    public function testPlayerTwoWinnerWithoutDuce()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(1, 1);
        $tennisGame->scorePoint(4, 2);

        $this->assertEquals('winner player2', $tennisGame->score());
    }

    public function testPlayerTwoWinnerWithDuce()
    {
        $tennisGame = new Tennis();
        $tennisGame->scorePoint(4, 1);
        $tennisGame->scorePoint(6, 2);

        $this->assertEquals('winner player2', $tennisGame->score());
    }

}
