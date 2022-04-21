<?php

namespace App\Service\Menu\Item;

use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractMenuItem
{
    protected AbstractMenuItem $nextItem;

    abstract public function add(ArrayCollection $menu): void;
}
