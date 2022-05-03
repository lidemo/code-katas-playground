<?php

namespace swkberlin\NinetyNineBottles;

class Lyric
{

    public function song() : Array
    {
        for($i=99; $i >= 97; $i--) {

            $this->verse($i);
        }
    }

    public function verse($number) : String
    {
        return "$number bottles of beer on the wall\n".
        "$number bottles of beer\n" .
        "Take one down and pass it around\n" .
        ($number - 1) ." bottles of beer on the wall\n";
    }

}
