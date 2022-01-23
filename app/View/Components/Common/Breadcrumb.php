<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $steps = [];

    public function __construct($steps){
        $this->steps = $steps;
    }

    public function render(){
        return view('components.common.breadcrumb');
    }
}
