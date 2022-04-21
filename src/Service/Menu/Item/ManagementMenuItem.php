<?php

namespace App\Service\Menu\Item;

use App\Model\Menu\MenuItemModel;
use Doctrine\Common\Collections\ArrayCollection;

class ManagementMenuItem extends AbstractMenuItem
{
    public function add(ArrayCollection $menu): void
    {
        $menu->add(new MenuItemModel(
            'front.management.dashboard',
            'Administracja placówki'
        ));
    }
}
