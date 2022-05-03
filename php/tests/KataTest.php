<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use swkberlin\Kata;

require __DIR__ . '/../vendor/autoload.php';

class KataTest extends TestCase
{

    public function testTwoRolls()
    {
        $kata = new Kata();
 
        for ($i=1; $i <= 10; $i++) {
            $kata->roll(10);
        }

        $this->assertEquals('100', $kata->score());
    }

    public function testNotFailing()
    {
        $this->assertTrue(true);
    }

}
