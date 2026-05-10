<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PublicLayout extends Component
{
    public $mainClasses;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($mainClasses = null)
    {
        $this->mainClasses = $mainClasses;
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.public');
    }
}
