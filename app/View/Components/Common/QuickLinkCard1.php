<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;

class QuickLinkCard1 extends Component{
    public $cardNo, $faIcon, $title, $routeName, $linkName;
    public function __construct($cardNo, $faIcon, $title, $routeName, $linkName){
        $this->cardNo = $cardNo;
        $this->faIcon = $faIcon;
        $this->title = $title;
        $this->routeName = $routeName;
        $this->linkName = $linkName;
    }

    public function render(){
        return view('components.common.quick-link-card1');
    }
}
