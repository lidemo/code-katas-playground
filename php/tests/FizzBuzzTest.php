<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use swkberlin\FizzBuzz;

class FizzBuzzTest extends TestCase
{

    public function testMultiplesOfThree()
    {
        $fizzBuzz = new FizzBuzz();

        foreach([3, 6, 9, 12] as $number) {
            $this->assertEquals('Fizz', $fizzBuzz->convert($number));
        }
    }

    public function testReturnsBuzz()
    {
        $fizzBuzz = new FizzBuzz();

        foreach([5, 10, 20] as $number) {
            $this->assertEquals('Buzz', $fizzBuzz->convert($number));
        }
    }

    public function testReturnsFizzBuzz()
    {
        $fizzBuzz = new FizzBuzz();

        foreach([15, 30, 45] as $number) {
            $this->assertEquals('FizzBuzz', $fizzBuzz->convert($number));
        }
    }

    public function testReturnsFizzIfThreeInInput()
    {
        $fizzBuzz = new FizzBuzz();

        foreach([3, 13, 31] as $number) {
            $this->assertEquals('Fizz', $fizzBuzz->convert($number));
        }
    }

    public function testReturnsBuzzIfFiveInInput()
    {
        $fizzBuzz = new FizzBuzz();

        foreach([56, 58] as $number) {
            $this->assertEquals('Buzz', $fizzBuzz->convert($number));
        }
    }

}
