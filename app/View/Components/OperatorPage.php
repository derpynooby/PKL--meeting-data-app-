<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OperatorPage extends Component
{
    /**
     * Create a new component instance.
     */

    public $link = [
        'roleIndex' => 'role.index',     
        'roleStore' => 'role.store',     
        'roleUpdate' => 'role.update',     
        'roleDelete' => 'role.delete',     
        'locationIndex' => 'location.index',     
        'locationStore' => 'role.store',     
        'locationUpdate' => 'location.update',     
        'locationDelete' => 'location.delete',     
    ];
     
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.operator-page');
    }
}
