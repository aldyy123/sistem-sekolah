<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PanelSchedule extends Component
{
    /**
     * Create a new component instance.
     */

     public $schedules;

    public function __construct($schedules, public $user)
    {
        $this->schedules = $schedules;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.panel-schedule');
    }
}
