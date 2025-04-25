<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableList extends Component
{
    public $listData;
    public $headings;

    /**
     * Create a new component instance.
     */
    public function __construct($listData = null,$headings=null)
    {
        $this->listData = $listData;
        $this->headings = $headings;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table-list');
    }
}
