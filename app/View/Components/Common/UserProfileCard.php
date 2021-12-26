<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;

class UserProfileCard extends Component
{
    public $id, $title, $subTitle, $description, $email, $contactNo, $status;
    public function __construct($id, $title, $subTitle, $description, $email, $contactNo, $status){
        $this->id = $id;
        $this->title = $title;
        $this->subTitle = $subTitle;
        $this->description = $description;
        $this->email = $email;
        $this->contactNo = $contactNo;
        $this->status = $status;
    }

    public function render(){
        return view('components.common.user-profile-card');
    }
}
