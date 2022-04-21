<?php

namespace App\Service\Menu\Item;

use App\Controller\Patient\Dashboard\ViewController;
use App\Model\Menu\MenuItemModel;
use Doctrine\Common\Collections\ArrayCollection;

class PatientMenuItem extends AbstractMenuItem
{
    public function __construct()
    {
        $this->nextItem = new DoctorMenuItem();
    }

    public function add(ArrayCollection $menu): void
    {
        $menu->add(new MenuItemModel(
            ViewController::ROUTE_NAME,
            'Pacjent'
        ));

        $this->nextItem->add($menu);
    }
}
