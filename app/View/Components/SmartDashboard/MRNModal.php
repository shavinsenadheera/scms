<?php

namespace App\View\Components\SmartDashboard;

use Illuminate\View\Component;

class MRNModal extends Component{
    public $materialName, $modalName;

    public function __construct($materialName, $modalName){
        $this->materialName = $materialName;
        $this->modalName = $modalName;
    }

    public function render(){
        return view('components.smart-dashboard.m-r-n-modal');
    }
}
