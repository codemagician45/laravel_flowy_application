<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    public $icon;
    public $title;
    public $subtitle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $title, $subtitle = "")
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.header');
    }
}
