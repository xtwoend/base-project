<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Option extends Component
{
    public $parent;
    public $tab;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($option, $tab = '')
    {
        $this->parent = $option; 
        $this->tab = $tab;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.option');
    }
}
