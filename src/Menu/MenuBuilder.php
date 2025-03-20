<?php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    private FactoryInterface $factory;

    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root', ['childrenAttributes' => ['class' => 'navbar-nav']]);

        $menu->addChild('Home', [
            'route' => 'app_home',
            'attributes' => ['class' => 'nav-item'],
            'linkAttributes' => ['class' => 'nav-link'],
            'labelAttributes' => ['class' => 'nav-link'],
            'extras' => ['icon' => 'tabler:home'],
        ]);

        return $menu;
    }

    public function createUserMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root', ['childrenAttributes' => ['class' => 'nav flex-column']]);
        $firstSection = $menu->addChild('First Section', ['display' => false, 'childrenAttributes' => ['class' => 'nav flex-column']]);
        $firstSection->addChild('Profile', ['labelAttributes' => ['class' => 'dropdown-item']]);

        $menu->addChild('Settings', ['labelAttributes' => ['class' => 'dropdown-item']]);
        $menu->addChild('Logout', ['route' => 'app_logout', 'linkAttributes' => ['class' => 'dropdown-item']]);

        return $menu;
    }
}
