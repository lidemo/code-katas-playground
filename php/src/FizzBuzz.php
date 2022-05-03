<?php

namespace swkberlin;

class FizzBuzz
{

    public function convert(int $number)
    {
        $returnedNumber = '';

        if ($number % 3 == 0 || strpos($number, '3') !== false) {
            $returnedNumber .= 'Fizz';
        }

        if ($number % 5 == 0 || strpos($number, '5') !== false) {
            $returnedNumber .= 'Buzz';
        }

        return $returnedNumber ?: $number;
    }

}
