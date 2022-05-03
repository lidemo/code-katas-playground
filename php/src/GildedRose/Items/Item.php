<?php

namespace swkberlin\GildedRose\Items;

abstract class Item
{
    public $sellIn;
    public $quality;

    public function __construct(int $sellIn, int $quality)
    {
        $this->sellIn = $sellIn;
        $this->quality = $quality;
    }

    abstract public function tick();
}