<?php

namespace App\Service\Menu\Item;

use App\Model\Menu\MenuItemModel;
use Doctrine\Common\Collections\ArrayCollection;

class ReceptionistMenuItem extends AbstractMenuItem
{
    public function __construct()
    {
        $this->nextItem = new ManagementMenuItem();
    }

    public function add(ArrayCollection $menu): void
    {
        $menu->add(new MenuItemModel(
            'front.receptionist.dashboard',
            'Recepcja'
        ));

        $this->nextItem->add($menu);
    }
}
