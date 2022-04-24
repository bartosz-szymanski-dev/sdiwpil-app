<?php

namespace App\Model\Menu;

class MenuItemModel
{
    public string $route;
    public string $name;
    public string $icon;

    public function __construct(string $route, string $name, string $icon)
    {
        $this->route = $route;
        $this->name = $name;
        $this->icon = $icon;
    }
}
