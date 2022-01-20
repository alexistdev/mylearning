<?php

namespace App\View\Components\adminlte;

use Illuminate\View\Component;

class DashboardLayout extends Component
{
    public $title;
    public $tagSubMenu;
    public $totalNotif;

    public function __construct($title,$tagSubMenu,$totalNotif=null)
    {
        $this->title = $title;
        $this->tagSubMenu = $tagSubMenu;
        $this->totalNotif = $totalNotif;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.adminlte.dashboard-layout');
    }
}
