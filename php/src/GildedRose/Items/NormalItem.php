<?php

namespace swkberlin\GildedRose\Items;

use swkberlin\GildedRose\Items\Item;

class NormalItem extends Item
{
    public $sellIn;
    public $quality;

    public function tick()
    {
        $this->sellIn -= 1;
        $this->quality -=  1;

        if ($this->sellIn <= 0) {
            $this->quality -= 1;
        }

        if ($this->quality < 0) {
            $this->quality = 0;
        }
    }
}
