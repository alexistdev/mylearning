<?php

namespace App\View\Components\adminlte;

use Illuminate\View\Component;

class SidebarLayout extends Component
{
    public $tagSubMenu;

    public function __construct($tagSubMenu)
    {
        $this->tagSubMenu = $tagSubMenu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.adminlte.sidebar-layout');
    }
}
