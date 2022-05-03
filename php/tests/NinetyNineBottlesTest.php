<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use swkberlin\NinetyNineBottles\Lyric;

require __DIR__ . '/../vendor/autoload.php';

class NinetyNineBottlesTest extends TestCase
{

    public function testVerseOne()
    {
        $expected = "99 bottles of beer on the wall\n".
        "99 bottles of beer\n" .
        "Take one down and pass it around\n" .
        "98 bottles of beer on the wall\n";

        $lyric = new Lyric();
        $verse = $lyric->verse(99);

        $this->assertEquals($expected, $verse);
    }

    public function testVerseTwo()
    {
        $expected = "98 bottles of beer on the wall\n".
        "98 bottles of beer\n" .
        "Take one down and pass it around\n" .
        "97 bottles of beer on the wall\n";

        $lyric = new Lyric();
        $verse = $lyric->verse(98);

        $this->assertEquals($expected, $verse);
    }

}
