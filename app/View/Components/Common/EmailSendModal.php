<?php

namespace App\View\Components\Common;

use Illuminate\View\Component;

class EmailSendModal extends Component
{
    public $id, $email, $orderNo, $orderDate, $deliveryDate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $email, $orderNo, $orderDate, $deliveryDate)
    {
        $this->id = $id;
        $this->email = $email;
        $this->orderNo = $orderNo;
        $this->orderDate  = $orderDate ;
        $this->deliveryDate  = $deliveryDate ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.common.email-send-modal');
    }
}
