<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Option extends Component
{
    public $parent;
    public $tab;
    public $selected;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($option, $tab = '', $selected = NULL)
    {
        $this->parent = $option; 
        $this->tab = $tab;
        $this->selected = $selected;
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
