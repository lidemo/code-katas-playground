<?php

namespace swkberlin;

use Exception;

class StringCalculator
{
    const STANDARD_DELIMITERS = ["\n", ','];
    const MAX_NUMBER = 1000;

    public function add(String $numbers) : int
    {
        $this->dieIfNegatives($numbers = $this->getNumbers($numbers));

        $numbers = $this->removeGreaterThanMax($numbers);

        return array_sum($numbers);
    }

    protected function getNumbers(String $numbers) : Array
    {
        $delimiters = $this->getDelimiters($numbers);
        $numbers = $this->removeDelimiterFlags($numbers);

        $numbers = str_replace(array_merge(self::STANDARD_DELIMITERS, ...$delimiters), ',', $numbers);

        return array_map('intval', explode(',', $numbers));
    }

    protected function getDelimiters(String $numbers) : Array {
        preg_match_all('/(\[(.*?)\])|((?<=^\/\/).)/', $numbers, $delimiters);
        
        return $delimiters;
    }

    protected function removeDelimiterFlags(String $numbers) : String
    {
        return preg_replace('/(\/\/\[.*\])|(^\/\/.)/', '', $numbers);
    }
    
    protected function dieIfNegatives(Array $numbers) : void
    {
        $negatives = [];

        foreach($numbers as $number) {
            if ($number < 0) $negatives[] = $number;
        }

        if (!empty($negatives)) throw new Exception('negatives not allowed ' . implode(', ', $negatives));
    }

    protected function removeGreaterThanMax(Array $numbers)
    {
        return array_filter($numbers, fn($number) => $number < self::MAX_NUMBER);
    }

}
