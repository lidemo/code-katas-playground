<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use swkberlin\StringCalculator;

require __DIR__ . '/../vendor/autoload.php';

class StringCalculatorTest extends TestCase{

    public function testAddEmptyNumber()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("");

        $this->assertEquals('0', $result);
    }

    public function testAddEmptyAndRealNumber()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add(",5");

        $this->assertEquals('5', $result);
    }

    public function testAddSingleNumber()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("5");

        $this->assertEquals('5', $result);
    }

    public function testAddTwoRealNumbers()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("5,5");

        $this->assertEquals('10', $result);
    }

    public function testAddFiveNumbers()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add(",5,5,,10");

        $this->assertEquals('20', $result);
    }

    public function testAddNewLineNumbers()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("5\n5,10");

        $this->assertEquals('20', $result);
    }

    public function testAddChangeDelimiterToSemicolon()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("//;5;10");

        $this->assertEquals('15', $result);
    }

    public function testAddChangeDelimiterToSlash()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("///5/10");

        $this->assertEquals('15', $result);
    }

    public function testThrowsExceptionOnNegative()
    {
        $stringCalc = new StringCalculator();

        $this->expectExceptionMessage('negatives not allowed -5, -30');

        $result = $stringCalc->add("-5,10,-30");
    }

    public function testIgnoreValuesOver1000()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("5,10,10002,10024");

        $this->assertEquals('15', $result);
    }

    public function testEnclosedDelimiters()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("//[***]\n1***2***3");

        $this->assertEquals('6', $result);
    }

    public function testMultipleEnclosedDelimiters()
    {
        $stringCalc = new StringCalculator();
        $result = $stringCalc->add("//[***][//][,,]\n1***2***3//5,,5");

        $this->assertEquals('16', $result);
    }
}