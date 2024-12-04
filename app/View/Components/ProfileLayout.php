<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfileLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // You can pass data to the view here, if necessary
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.profile-layout');
    }
}