<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListItem extends Component
{
    /**
     * parse data
     */
    public $navigation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($navigation)
    {
        $this->navigation = $navigation;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-item');
    }
}
