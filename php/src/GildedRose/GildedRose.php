<?php

declare(strict_types=1);

namespace swkberlin\GildedRose;

use InvalidArgumentException;
use swkberlin\GildedRose\Items\AgedBrie;
use swkberlin\GildedRose\Items\BackstagePass;
use swkberlin\GildedRose\Items\Conjured;
use swkberlin\GildedRose\Items\NormalItem;
use swkberlin\GildedRose\Items\Sulfuras;

class GildedRose
{

    private static $items = [
        'normal'    => NormalItem::class,
        'Aged Brie' => AgedBrie::class,
        'Backstage passes to a TAFKAL80ETC concert' => BackstagePass::class,
        'Sulfuras, Hand of Ragnaros' => Sulfuras::class,
        'Conjured Mana Cake'    => Conjured::class
    ];

    public static function of($name, $quality, $sellIn)
    {

        if (!array_key_exists($name, self::$items)) {
            throw new InvalidArgumentException(sprintf('Item %s not found.', $name));
        }

        return new self::$items[$name]($sellIn, $quality);

    }
}