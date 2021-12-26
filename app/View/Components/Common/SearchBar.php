<?php

namespace App\View\Components\common;

use Illuminate\View\Component;

class SearchBar extends Component
{
    public $searchVal, $route;
    public function __construct($searchVal, $route){
        $this->searchVal = $searchVal;
        $this->route = $route;
    }

    public function render(){
        return view('components.common.search-bar');
    }
}
