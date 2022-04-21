<?php

namespace App\Model\Menu;

class MenuItemModel
{
    public string $route;
    public string $name;
    public function __construct(string $route, string $name)
    {
        $this->route = $route;
        $this->name = $name;
    }
}
